<?php

namespace App\Http\Controllers\api\v1;

use App\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;

class GovernorateController extends Controller
{
    //
    public function index() {
        return PlaceResource::collection(Governorate::all());
    }
}
