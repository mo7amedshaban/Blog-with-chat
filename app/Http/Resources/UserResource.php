<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[

            "id"=>$this->id,
            "username"=>$this->username,
            "email"=>$this->email,
            'phone'=>$this->phone,
            "profile_img"=>$this->profile_img,
            'added_at' =>$this->created_at,
            //"is_admin"=>$this->is_admin,

        ];
    }
}
