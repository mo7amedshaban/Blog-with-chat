<?php

namespace App\Http\Models;

use App\Http\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $guarded = [''];
    protected $fillable =['text','user_id','read','reciever_id','image'];
    public function user(){
        return $this->belongsTo(User::class);  //not forget frogein key in table of it
    }
    public function getCreatedAtAttribute($date)
    {
        // parse for make instance of Carbon
        return Carbon::parse($date)->diffForHumans();
    }
}
