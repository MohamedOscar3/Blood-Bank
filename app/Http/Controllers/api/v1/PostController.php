<?php

namespace App\Http\Controllers\api\v1;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            
            if ($request->category_id && $request->search) {
                // if user enter a keyword to search for it
                $posts = Post::where('category_id','=',$request->category_id)->where('content','like',"%{$request->search}%")->
                orWhere('title','like',"%{$request->search}%")->get();
        
                return PostResource::collection($posts);
                
            }elseif($request->category_id) {
                // if just enter a cat
                $posts = Post::where('category_id','=',$request->category_id)->get();
                return PostResource::collection($posts);
            } else {
                //if he don't enter any thing
                return PostResource::collection(Post::all());
            }
            
           
        
        
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
        $post = Post::find($id);
        if ($post->id) {
            return responseJson(1,$post->title,(new PostResource($post))->additional(['data' => ['content' => $post->content]]));
        }
        
        
    }


    // function to get the favorite posts of spacfic user
    public function favoritePosts(Request $request) {
       $favs = $request->user()->favorite;
       
       return responseJson(
1,
'success',
PostResource::collection($favs)
);

        
    }


}