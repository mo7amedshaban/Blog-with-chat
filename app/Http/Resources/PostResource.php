<?php

namespace App\Http\Resources;

use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Models\Comment;
class PostResource extends JsonResource
{

    public function toArray($request)
    {
        return [ //"data"               => []
            'id'               => $this->id,
            'user_id'          => $this->user_id,
            'category_id'      => $this->category_id,
            'title'            => $this->title,
            'body'             => $this->body,
            'slug'             => $this->slug,
            'image'            => $this->image,
            'added_at'         => $this->created_at,
            'nbposts'          => $this->count(),
            'comments_count'   => $this->comments->count(),
            "user"             => $this->user,                                              #belongsTo
            #"comments_count"  =>  //CommentResource::collection(Comment::all())->count(),
            'category'         => $this->category,                                          #this relation only
            #'comments'        => CommentResource::collection(Comment::all()),  //get all with all relations
            'comments'         => CommentResource::Collection($this->comments),             #hasMany   #have relations too



        ];
    }
}
