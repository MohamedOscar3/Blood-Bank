<?php

namespace App\Http\Controllers\api\v1;

use App\Favorite;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Resources\Json\Resource;

class FavoriteController extends Controller
{
    //
    public function toggle(Request $request) {
        $client = $request->user();
        
        $post = Post::find($request->post_id);
        
            
        
           $client->favorite()->toggle($post);

           return responseJson(1,'تم التحديث بنجاح');
       
       
       
        
        
       
    }
}
