<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Models\User;
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'post_id'=>$this->post_id,
            'user_id'=>$this->user_id,
            'added_at'=>$this->created_at,
            'body'=>$this->body,
            'user'=>$this->user,//UserResource::Collection(User::all()),


        ];
    }
}
