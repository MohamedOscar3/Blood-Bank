<?php

namespace App\Http\Controllers\api\v1;

use App\BloodType;
use App\Client;
use App\Favorite;
use App\Governorate;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Http\Resources\getTarget;
use App\Http\Resources\NotificationResource;
use App\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    //
    //get all the notfiication
    public function index() {
        $notifications =  Auth::user()->notifications()->get();
        
             
        
        return  NotificationResource::collection($notifications);
    }



    
    public function show($id) {
        $notification = Notification::find($id);
        
        if ($notification) {
            Auth::User()->notifications()->updateExistingPivot($notification,['read_statue'=>1]);

            return  new DonationResource($notification->donation);
            
        } else {
            return new Resource(['status' => 'غير موجود']);
        }


    }

    // get the count of unreading notification 
    public function count_unreading() {
        
        $notifications = Auth::user()->notifications()->where('read_statue','=',0)->get();
        return $notifications->count();
        

        
    }

    //get the targets values
    public function getTarget(Request $request) {
        $govIds = $request->user()->governorate_target()->pluck('governorates.id')->toArray();
        $bloodIds = $request->user()->blood_type_target()->pluck('blood_types.id')->toArray();
        return responseJson(1,'الاشعارات المستهدفة',['govIds' => $govIds,'bloodIds' => $bloodIds]);
        
        
            
        
    }
   

    public function target(Request $request) {
        
        //delete all other favourite and add new favourite
        
        if (
        Auth::user()->blood_type_target()->sync($request->blood_type)
        &&
        Auth::user()->governorate_target()->sync($request->governorate)) {
            return responseJson(1,'تم تحديث القائمة المفضلة');
            
        };
        
        
        
    }
}
