<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Models\Post;
use App\Http\Models\User;
use App\Http\Models\Comment;
use App\Notifications\NotifyOwner;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotifyOwnerTest extends TestCase
{
    use RefreshDatabase;
              /** @test */
    public function it_use_the_correct_driver(){
        $this->withoutExceptionHandling();
        //driver here is via in event
        $expectedDrivers =['database','broadcast'];
        $post = factory(Post::class)->create();     //here not use $post=create('Post') because you want send object to constructor not array of object
        $comment =factory(Comment::class)->create();

        $notifications = new NotifyOwner($comment,$post);
        $this->assertEquals($expectedDrivers,$notifications->via(new User));

    }

        /** @test */
    public function check_mail_send_correct_message(){
        $post = factory(Post::class)->create();
        $comment =factory(Comment::class)->create();
        $user =factory(User::class)->create();

        $notifications = new NotifyOwner($comment,$post);
        $message = $notifications->toMail($user);  #or  toMail(new User);

        $introLines =[
            'The introduction to the notification.'
        ];
        $outroLines =[
            'Thank you for using our application!'
        ];
        $actionText ='Notification Action';
        $actionUrl = route('posts.index');
        $subject = 'Hello';
        $this->assertEquals($introLines,$message->introLines);
        $this->assertEquals($outroLines,$message->outroLines);
        $this->assertEquals($actionText,$message->actionText);
        $this->assertEquals($actionUrl,$message->actionUrl);
        $this->assertEquals($subject,$message->subject);
    }
    /** @test */
    public function check_toArray_recieved(){ // toArray()  --> is database recieved
        $post = factory(Post::class)->create();
        $comment =factory(Comment::class)->create();
        $user =factory(User::class)->create();

        $notifications = new NotifyOwner($comment, $post);
        $Array =$notifications->toArray(new User);   //toArray(new User);
        //dd($comment->user);
        $this->assertEquals($comment->user, $Array['comment_owner']);
        $this->assertEquals($comment->created_at, $Array['commented_at']);
        $this->assertEquals($post, $Array['post']);
    }
    /** @test */
    public function check_toBroadcast_sender(){ // toArray()
        $post = factory(Post::class)->create();
        $comment =factory(Comment::class)->create();

        $notifications = new NotifyOwner($comment, $post);
        $broadcast =$notifications->toBroadcast(new User);   //toArray(new User);
        //dd($comment->user);
        $this->assertEquals($comment->user, $broadcast->data['data']['comment_owner']);
        $this->assertEquals($comment->created_at, $broadcast->data['data']['commented_at']);
        $this->assertEquals($post, $broadcast->data['data']['post']);
    }

}
