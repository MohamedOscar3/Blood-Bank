<?php

namespace App\Http\Controllers\api\v1;

use App\Client;
use App\client_password_resets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\ClientResource;
use App\Mail\ClientReset;
use App\Token as AppToken;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Psy\Util\Str;
use Symfony\Component\CssSelector\Parser\Token;

class ClientController extends Controller
{
    
    /**
     * make login to the app
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function Login(LoginRequest $request) {
         $values = $request->validated();
        
         $client = Client::Where('phone_number',$values['phone_number'])->first();
         
         if ($client) {
             
            if(Hash::check($values['password'],$client->password)) {
                
                if (key_exists('phone_token',$values)) {
                    
                    AppToken::where('token','=',$values['phone_token'])->delete();

                    $client->getToken()->create(['token' => $values['phone_token'],'client_id'=> $client->id, 'type'=>$values['type']]);
                }
                //delete the token
              
                
                return responseJson(1,'تم تسجيل الدخول',[
                    'api_token' => $client->api_token,
                    'name' => $client->name,
                    
                ]);
            } else {
                return responseJson(0,'رقم الهاتف او كلمة المرور غير صحيحة');
            } 
         } else {
            return responseJson(0,'رقم الهاتف او كلمة المرور غير صحيحة');
        }
        
           
         
         
        
         
     }


     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        //
        $validateClient = $request->validated();
        
        $validateClient['password'] = Hash::make($validateClient['password']);
        
        $validateClient['api_token'] = \Str::random(80);
        
        $client = Client::create($validateClient);
        
        return ResponseJson(1,'تم إنشاء المستخدم بنجاح' ,new ClientResource($client));
        
        
        
            
        
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        //
    }
    

    public function reset(Request $request) {
        $validator = \Validator::make($request->all(), [
            'email' => 'required'
            
        ]);

        if ($validator->fails()) {
            return responseJson('0','the email is requierd');
        }

        $client = Client::where('email',$request->email)->first();
        if ($client) {
            client_password_resets::where('email',$request->email)->delete();
            $token = client_password_resets::create(['email'=>$request->email,'token'=>\Str::random(6),
            'created_at'=>Carbon::parse(Carbon::now(),'Africa/Cairo')]);

            Mail::to($request->email)->send(
                new ClientReset($token)
            );

            
            
        }

        return responseJson('1','the email is sended if you are sign up before you will find it in your inbox');
    }

    public function resetPass(Request $request) {
        $validator = \Validator::make($request->all(), [
            'email' => 'required',
            'token' => 'required',
            'password'=> 'required|confirmed'
            
        ]);

        if ($validator->fails()) {
            return responseJson('0','your token is incorrect or password');
        }

        $confirm = client_password_resets::where('token',$request->token)->first();
        
        if ($confirm) {
            
            if(Carbon::parse(Carbon::now(),'Africa/Cairo')->diffInMinutes($confirm->created_at) > 1) {
                return responseJson('0','time out');
            } else {
                $client = Client::where('email',$request->email)->first();
                
                $client->password = Hash::make($request->password);
                $client->save();
                $confirm = client_password_resets::where('token',$request->token)->delete();
                return responseJson('1','Your Password Changed Successfuly');
            }
        }
    }

    
}
