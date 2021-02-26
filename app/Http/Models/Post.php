<?php

namespace App\Http\Models;
use App\Http\Models\User;
use App\Http\Models\Category;
use App\Http\Models\Comment;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Carbon;
class Post extends Model
{
    protected $fillable = ['title','slug','body','image','user_id','category_id'];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    protected $hidden =['pivot'];
    public function getCreatedAtAttribute($date)
    {
        // parse for make instance of Carbon
        return Carbon::parse($date)->diffForHumans();
    }

    public $guarded = [''];

    public function getRouteKeyName(){  // instead of   find::id  -->   find::slug
       return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    // public function getImageAttribute($val)
    // {
    //     return ($val !== null) ? asset('photos/'.$val) : "";

    // }



}
