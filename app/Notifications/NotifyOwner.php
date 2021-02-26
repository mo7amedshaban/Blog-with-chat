<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;  //add
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;   //add
use App\Http\Models\Comment;
use App\Http\Models\Post;

class NotifyOwner extends Notification implements ShouldBroadcast //add
{
    use Queueable;
    public $comment_owner;
    public $commented_at;
    public $post;

    public function __construct(Comment $comment,Post $post)
    {
        $this->comment_owner = $comment->user;
        $this->commented_at = $comment->created_at;
        $this->post = $post;

    }


    public function via($notifiable) // where send data
    {
        return ['database','broadcast']; // for database i created   php artisan notifications:table
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Hello')
                    ->line('The introduction to the notification.')  //introLines
                    ->action('Notification Action',route('posts.index'))
                    ->line('Thank you for using our application!'); //outroLines
    }
    // public function toMail($notifiable)
    // {
    //     $message = (new MailMessage)
    //                 ->subject('Hello')
    //                 ->line('The introduction to the notification.');  //introLines

    //            if($this->Post->relationship->count() == 0 )
    //                 message->line('no posts or emptiy');

    //     return message->action('Notification Action',route('posts.index'))
    //            ->line('The introduction to the notification.');
     //
    // }


    public function toArray($notifiable)   // store data in database
    {  // get data from constractur for using
         return [
            'comment_owner'=>$this->comment_owner,
            'commented_at'=>$this->commented_at,
            'post'=>$this->post,
        ];
    }

    public function toBroadcast($notifiable)   //add this function for use send Broadcasting
    {
        return new BroadcastMessage([
           'data'=>[
            'comment_owner'=>$this->comment_owner,
            'commented_at'=>$this->commented_at,
            'post'=>$this->post,
           ]
        ]);
    }
}
