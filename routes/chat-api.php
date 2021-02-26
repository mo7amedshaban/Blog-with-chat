<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

 Auth::routes();
Route::group(['middleware' => ['auth:sanctum']],function(){

    Route::get('messages/{id}', 'ContactsController@fetchMessages');  //id not $id
    Route::post('messages', 'ContactsController@sendMessage');
    Route::get('message_unread','ContactsController@message_unread');
    Route::get('/contacts', 'ContactsController@getContacts')->name('getContacts');

});


Broadcast::routes(['middleware' => ['auth:sanctum']]);



