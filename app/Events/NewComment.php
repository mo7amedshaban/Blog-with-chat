<?php

namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\http\Models\User;
class NewComment implements ShouldBroadcast      ## add  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    # i want user and comment it self
    public $user;
    public $comment;
    public function __construct(User $user ,$comment)
    {
        $this->user= $user;
        $this->comment = $comment;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('newComment.'.$this->comment->post_id);
    }
}
