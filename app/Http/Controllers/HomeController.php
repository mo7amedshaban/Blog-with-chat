<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\http\Models\Post;
use App\http\Models\Category;
use App\Http\Resources\PostResource;
use App\Http\Resources\CategoryResource;

class HomeController extends Controller
{



    public function test(Post $post){
        $category = Category::has('posts')->get();
         return CategoryResource::collection($category);

    }

    public function __construct()
    {
       // $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }
}
