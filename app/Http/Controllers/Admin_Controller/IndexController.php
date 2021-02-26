<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\http\Models\Category;
use App\http\Models\Post;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Str;
use App\Http\Requests\PostRequest;

class IndexController extends Controller
{
    public function __constract(){
        $this->middleware('admin');
    }

    public function getPosts() //index
    {

        $posts = Post::latest()->with('user')->with('category')->paginate(6);
        return PostResource::Collection($posts);

    }

    public function getCategories()
    {
        $categories  = Category::get();
        return CategoryResource::Collection($categories);
    }

    public function addPost(PostRequest $request)
    {
        # store  make name is hash  and put file or image in disk driver
         $filename = '';
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('','photos');  //store('createFolder','Driver')   in storage path

        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'image' => $filename,   //image
        ]);
        return new PostResource($post);
    }


    public function updatePost(Request $request)
    {

        $post = Post::findOrfail($request->id);
        $filename = $post->image;
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('','photos');
        }

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->image = $filename != '' ? $filename : $post->image;
        $post->save();
        return PostResource::Collection($post->get());
    }

    public function deletePosts(Request $request)
    {
       $ids = $request->posts_ids;  //really get post_ids from script as  []
       Post::whereIn('id',$ids)->delete();       // wheneIn('',[])   must use seconde param array
       return response()->json(['message' => 'deleted',null],204);
    }

}







