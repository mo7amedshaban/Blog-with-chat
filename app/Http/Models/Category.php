<?php

namespace App\Http\Models;
use App\http\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Category extends Model
{
    //

    public $guarded = [''];
    public function posts(){
        return $this->hasMany(Post::class);
    }




    public function getCreatedAtAttribute($date)
    {
        // parse for make instance of Carbon
        return Carbon::parse($date)->diffForHumans();


    }
}
