<?php

namespace App\Http\Controllers\api\v1;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\ClientResource;
use App\Token as AppToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    
}
