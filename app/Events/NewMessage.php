<?php

namespace App\Events;

use App\Http\Models\User;
use App\Http\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessage  implements ShouldBroadcast   //add
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message;
    public $message_count;
    public function __construct(Message $message,$message_count)
    {
        $this->message = $message;
        $this->message_count = $message_count;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('Private_Chat.'.$this->message->reciever_id);
    }
}
