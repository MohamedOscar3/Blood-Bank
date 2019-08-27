<?php

namespace App\Http\Controllers\api\v1;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;

class CityController extends Controller
{
    //
    public function index(Request $request) { 
        
        $cites = City::where('governorate_id','=',$request->id)->get();
        
        return responseJson(1,'اسماء المدن',$cites);
    }
    

    
}
