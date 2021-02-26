<?php

namespace App\Http\Models;

use App\Http\Models\Post;
use App\Http\Models\User;
use App\Events\NewComment;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $guarded = [''];
    public function getCreatedAtAttribute($date)
    {
        // parse for make instance of Carbon
        return Carbon::parse($date)->diffForHumans();


    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posts(){
        return $this->hasOne(Post::class);
    }

}
