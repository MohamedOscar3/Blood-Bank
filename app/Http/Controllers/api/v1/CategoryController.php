<?php

namespace App\Http\Controllers\api\v1;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    //
    public function index () {
        return  responseJson(1,'قائمة الفئات ', CategoryResource::collection(Category::all()));
    }
}
