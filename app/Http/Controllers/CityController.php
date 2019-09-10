<?php

namespace App\Http\Controllers;

use App\City;
use App\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('city.index')->with(['cities'=>City::all(),'governorates'=>Governorate::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'city_name' => 'required',
            'governorate_id'=>'required'
        ]);
        
        City::create($validate);
        return back()->with('msg','the city created successfuly');
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

        $validate = $request->validate([
            'city_name' => 'required',
            'governorate_id'=>'required'
        ]);

        City::find($id)->fill($validate)->save();
        return back()->with('msg','the governorate updated sucssefuly');
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
    City::findOrFail($id)->delete();
        return back()->with('msg',"the city deleted successfuly");
    }
}
