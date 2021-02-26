<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Models\Post;
use App\Http\Models\User;
use App\Events\NewComment;
use App\Http\Models\Comment;
use Laravel\Sanctum\Sanctum;
use App\Events\UnreadMessages;
use App\Notifications\NotifyOwner;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function comment_create()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['view-tasks']
        );
        $this->withoutExceptionHandling();///Users/mac/Desktop/laravel/Blog/app/Notifications/NotifyOwner.php

        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $comment = factory(Comment::class)->create();
        #use it after create factories
        Notification::fake(); //use it not send in constructor  of NotifyOwner any params
        Event::fake();

        $response = $this->json('POST','api/comment/create',[
            'body'      => 'hello every body',
            'user_id'   => 1,//$user[0]['id'],
            'post_id'   => 1,//$post[0]['id'],
        ]);

        $response->assertStatus(201);
        Notification::assertSentTo(User::latest()->first(), NotifyOwner::class); //use it after json api
        Event::assertDispatched(NewComment::class);  //broadcast
    }



}
