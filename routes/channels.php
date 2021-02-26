<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;



// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
Broadcast::channel('users.{id}', function ($user, $id) {   //for notifications

    return (int) $user->id === (int) $id;

});

Broadcast::channel('newComment.{post_id}', function ($user, $post_id) {  //add nam of channel of broadcastOn
    return true; //auth()->check();
});

# --> chat
Broadcast::channel('Private_Chat.{reciever_id}', function ($user) {

    return auth()->check();
});
Broadcast::channel('presence_for_private_chat', function ($user) {

    return $user;
});








/******* this name
 *      public function broadcastOn()
        {
            return new PrivateChannel('newComment.'.$this->comment->PostResource_id);
        }
 */
