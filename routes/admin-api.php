<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

Auth::routes();

Route::post('loginAdmin','Admin_Controller\LoginController@loginAdmin');


Route::group(['prefix'=>'/admin','namespace'=>'Admin_Controller','middleware' => ['auth:sanctum']],function(){
    Route::get('posts','IndexController@getPosts');
    Route::get('categories','IndexController@getCategories');
    Route::post('addPost','IndexController@addPost');   //store
    Route::post('updatePost/{id}','IndexController@updatePost');  //update
    Route::post('deletePosts','IndexController@deletePosts'); //delete



});

// Broadcast::routes(['middleware' => ['auth:sanctum']]);
