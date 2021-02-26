<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;


Auth::routes();   //not use it in bottom  focus focus focus

Route::get('test','User_Controller\PostController@test');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});


Route::group(['namespace'=>'User_Controller'],function(){
    Route::get('category/{slug}/posts','PostController@categoryPosts'); //name
    Route::get('searchposts/{query}','PostController@searchposts');
    Route::apiResources([
        'posts'      => 'PostController',
        'categories' => 'CategoryController',
    ]);
    Route::post('login_user', 'UserController@login_user');
    Route::post('register_user', 'UserController@register_user');
    Route::post('update_user_profile/{id}', 'UserController@update_user_profile');
    Route::post('change_password/{id}', 'UserController@change_password');
});

Route::group(['namespace'=>'User_Controller','middleware'=>['auth:sanctum']],function () {
    Route::get('user','UserController@details');  //current user
    Route::post('comment/create', 'CommentController@store');   //here
    Route::get('getUnreadNotifications', 'UserController@getUnreadNotifications');
    Route::get('getAllNotifications', 'UserController@getAllNotifications');
     //Route::put('markNotificationAsRead', 'UserController@markNotificationAsRead');

});  //first route

// Broadcast::routes(['middleware' => ['auth:sanctum']]);

