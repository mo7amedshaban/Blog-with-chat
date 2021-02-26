<?php

namespace App\Http\Models;

use Throwable;
use App\Http\Models\Post;
use App\Http\Models\Message;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;   //add
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [ 'username', 'email', 'password','profile_img'];

    protected $hidden = ['remember_token', ];

    protected $casts = ['email_verified_at' => 'datetime', ];

     public function posts(){
        return $this->hasMany(Post::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);

    }
    public function getCreatedAtAttribute($date)
    {
        // parse for make instance of Carbon
        return Carbon::parse($date)->diffForHumans();
    }
    public function getPhoneAttribute($val)
    {
        // parse for make instance of Carbon
         return ($val == null) ?  "No Number": $val;
    }


    public function receivesBroadcastNotificationsOn()    //for recive broadcast notification
    {
        return 'users.'.$this->id;      //return channelName
    }


}
