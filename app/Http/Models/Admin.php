<?php

namespace App\Http\Models;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;   //add
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;
    //protected $guard = 'api-admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [ 'password', 'remember_token' ];



}
