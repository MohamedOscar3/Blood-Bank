<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    //
    public function edit($id) {
        return view('config.edit')->with(['config'=>Config::first()]);
    } 

    public function update($id = 1,Request $request) {
        $validate = $request->validate([
            
            'phone_number' => 'required',
            'fb' => 'required',
            'tw'=> 'required',
            'email' => 'required',
            'insta' =>'required',
            'gplus' => 'required',
            'youtube' => 'required'
        ]);

        if ($validate) {
            $config = Config::find(1);
            $config->fill($validate);
            
            $config->save();
            dd($config);
            return back()->with('msg','the config updated successfuly');
        } else {
            return back()->with('errors');
        }
    }
}
