<?php

namespace App\Http\Controllers\User_Controller;

use App\Http\Models\Post;
use App\Http\Models\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PostController extends Controller
{


    public function test()
    {
        $process = new Process(['python3', '/Users/mac/Desktop/laravel/Blog/KNN.py']);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $data = $process->getOutput();
        dd($data);

    }









    public function index()
    {
        $post = Post::latest()->paginate(5);
        return PostResource::Collection($post);
    }



    public function show(Post $post)  //postDetails
    {
        $post = Post::whereSlug($post->slug)->get();
        return PostResource::Collection($post);
    }

    public function destroy(Post $post)
    {
        //
    }
    public function categoryPosts($slug)
    {
        $category = Category::whereSlug($slug)->first();

        $post = Post::where('category_id', $category->id)->with('user')->get(); //optional($category)->id

        return PostResource::Collection($post);
    }


    public function searchposts($query)
    {
        $post = Post::where('title', 'like', '%' . $query . '%')->with('user')->paginate(3);
        return PostResource::collection($post);
    }
}
