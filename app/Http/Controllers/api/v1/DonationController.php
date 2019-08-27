<?php

namespace App\Http\Controllers\api\v1;

use App\BloodType;
use App\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DonationRequest;
use App\Http\Resources\DonationResource;
use App\Client;

use App\Governorate;

use App\Notification;
use App\Token;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;


class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
            if ($request->blood_type_id) {

                return ResponseJson(1,'قائمة التبرعات' ,DonationResource::collection(Donation::where('blood_type_id',$request->blood_type_id)->get())) ;    

            } elseif ($request->governorate_id) {

                return ResponseJson(1,'قائمة التبرعات' ,DonationResource::collection(Donation::where('governorate_id',$request->governorate_id)->get())) ;    

            } elseif ($request->governorate_id && $request->blood_type_id )  {

                return ResponseJson(1,'قائمة التبرعات' ,DonationResource::collection(Donation::where('governorate_id',$request->governorate_id)->where('blood_type_id',$request->blood_type_id)->get())) ;    

            }

            return ResponseJson(1,'قائمة التبرعات' ,DonationResource::collection(Donation::all())) ;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonationRequest $request)
    {
        //

        $validateDonation = $request->validated();
        //create donation
        
        $validateDonation['client_id'] = $request->user()->id;
        
        $donation = Donation::create($validateDonation);
        
     
        // create notification
        $notification = Notification::create(['title' => "حالة تبرع في محافظة " . $donation->governorate->governorate_name,
        'donation_id' => $donation->id,
        'content' => 'حالة تبرع جديدة في مستشفي ' . $donation->hospital_name .  ' عدد اكياس الدم المطلوب ' . $donation->number_of_blood_cysts
        ]);
        

        if ($donation->id && $donation->has('notification')) {
            Self::sendNotificationForAllUsers($notification,$donation);
            return responseJson(1,'تم ارسال التبرع بنجاح');
        } else {
            return   responseJson(0,'خطأ');
        }

    }

    private static function sendNotificationForAllUsers($notification,$donation) {
        /**
         * send notification for all users that don't have a spacfic target 
         * after that send to the users that target spacfic bloodtype or city
         * 
         */
        
        // this array to get all the ids that we will send notification for it

        $arrayOfIds=[];
         
         $clients = Client::doesntHave('governorate_target')->doesntHave('blood_type_target')->get();
        
         if (count($clients)) {
             
            foreach ($clients as $client ) {
                array_push($arrayOfIds,$client->id);
                $client->notifications()->attach($notification);

             }
             
         }


         $targetsClient = Client::whereHas('blood_type_target',function (Builder $query) use($donation) {
            $query->where('clientables_id','=',$donation->blood_type_id);
         })->orWhereHas('governorate_target',function (Builder $query) use($donation) {
            $query->where('clientables_id','=',$donation->governorate_id);
         })->get();

         
         
         if (count($targetsClient))
         foreach($targetsClient as $tClient) {
             array_push($arrayOfIds,$tClient->id);
            $tClient->notifications()->attach($notification);
         }



        //send the nottification
      /*   $array_of_tokens=[];
        $clientHasTokens = Client::whereIn('id',$arrayOfIds)->get();
        foreach ($clientHasTokens as $clientToken) {
            $token = $clientToken->getToken()->whereIn('client_id',$arrayOfIds)->first();

            array_push($array_of_tokens,$token['token']);
        }*/
        
        $tokens = Token::WhereIn('client_id',$arrayOfIds)->where('token','!=',"")->pluck('token')->toArray();
        
        if (count($tokens)) {
            $title = $notification->title;
            $body=$notification->content;
            $data = [ 
                'donation_request_id' => $notification->donation_id ] ;

                $send =     notifyByFirebase($title,$body,$tokens,$data);
        }
         
        }       

         
         


    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $donation = Donation::find($id);
        
        if ($donation) {
            return (new DonationResource($donation))->additional(['data'=>['age'=>$donation->age,'number_of_blood_cysts'=>$donation->number_of_blood_cysts,'notes'=>$donation->notes]]);
        }
        return responseJson(0,'طلب التبرع غير موجود');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
