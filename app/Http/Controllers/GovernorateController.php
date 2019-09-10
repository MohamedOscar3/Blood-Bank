<?php

namespace App\Http\Controllers;

use App\Governorate;

use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('governorate.index',['governorates'=>Governorate::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $validate = $request->validate(['governorate_name'=> 'required']);
        
        

        if ($validate) {
            Governorate::create($validate);
            return back()->with('msg','the governorate have been updated successfuly');
        } 
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
        $validate = $request->validate(['governorate_name'=>'required']);

        if ($validate) {
            Governorate::find($id)->fill($validate)->save();
            return back()->with('msg','the governorate updated sucssefuly');
        } else {
            return back()->with('errors');
        }
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
    
        Governorate::findOrFail($id)->delete();
        return back()->with('msg',"the gonverorate deleted successfuly");
    }
}
