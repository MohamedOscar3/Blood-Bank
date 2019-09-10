<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Message;

class MassageController extends Controller
{
    //
    
    public function store(MessageRequest $request) {
        $validate = $request->validated();
        $validate['client_id'] = $request->user()->id;
        
        Message::create($validate);
        
        return responseJson('1','your message have been send successfuly');
    }
}
