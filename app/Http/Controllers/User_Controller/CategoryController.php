<?php
namespace App\Http\Controllers\User_Controller;

use App\Http\Controllers\Controller;

use App\http\Models\Category;
use App\http\Models\Post;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
class CategoryController extends Controller
{




    public function index()
    {
        $category = Category::has('posts')->get();
        return CategoryResource::Collection($category);
    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        //
    }


    public function update(Request $request, Category $category)
    {
        //
    }


    public function destroy(Category $category)
    {
        //
    }
}
