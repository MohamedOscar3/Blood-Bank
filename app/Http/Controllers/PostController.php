<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use App\thumbnail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index() {
        return view('post.index')->with(['posts'=>Post::all()]);
    }

    public function show($id) {
        return view('post.show')->with(['post'=>Post::findOrFail($id)]);
    }

    public function edit($id) {
        return view('post.edit')->with(['post'=>Post::findOrFail($id),'categories'=>Category::all()]);
    }

    public function update(Request $request,$id) {
        $validate = $request->validate([
            'title'=> 'max:100',
            'thumbnail'=> 'max:255',
            'content'=> 'min:20',
            'category_id',
        ]);

        if ($validate) {
            $post = Post::findOrFail($id);
            $post->fill($validate);
            $post->save();
            return redirect()->route('post.show',['post'=>$post->id])->with('msg','the post have been updated successfuly');
 
        } else {
            return back()->with('errors');
        }
    }
    //
    public function create() {
        
        if (Auth::user()->can('create-post')) {
            
            return view('post.create')->with(['categories'=>Category::all()]);
        } else {
            return abort(403);
        }
        
    }

    public function store(PostRequest $request) {
        if (Auth::user()->can('create-post')) {
        $validate = $request->validated();
        
        $thumbnail = thumbnail::create(['image_name'=>$validate['thumbnail'],'alt'=>'Post Description Image']);

        $post =new Post();
        $post->title = $validate['title'];
        $post->category_id = $validate['category_id'];
        $post->thumbnail_id = $thumbnail->id;
        $post->content = $validate['content'];
        $post->save();
        if($post) {
            return back()->with('msg',"the post have been added successfuly");
        } else {
            return back()->with('errors');
        }

    } else {
        abort(403);
    }
}


public function destroy($id) {
    if (Auth::user()->can('delete-post')) {
        Post::findOrFail($id)->delete();
        return redirect()->route('post.index')->with('msg',"the post have been deleted succsessfuly");
    } else {
        abort(403);
    }
}


}
