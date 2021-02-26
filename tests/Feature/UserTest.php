<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Models\Post;
use App\Http\Models\User;
use App\Http\Models\Comment;
use Laravel\Sanctum\Sanctum;
use App\Notifications\NotifyOwner;
use Faker\Factory;              //add
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Log;

class UserTest extends TestCase
{
    use RefreshDatabase;
    //use WithoutMiddleware;

    /**
     * given
     * when
     */

    /** @test */
    public function check_validation_of_register(){
        $this->json('POST','api/register',[
            'name'  =>null,
            'email' => null,
            'password' => null,
        ])->assertStatus(422)
        ->assertJsonValidationErrors(['name','email','password']);
    }
     /** @test */
    public function user_register()
    {
          $data = [
            'name' =>'mohaemdsahban',
            'email' =>'MOHAMEDMOHAMED@gmail.com',
            'password' => '123123123',
            'password_confirmation'=>'123123123'
          ];

        $response =$this->json('POST','api/register',$data)
            ->assertStatus(201);
            $this->assertDatabaseHas("users",[
                 'name' =>'mohaemdsahban',
                 'email' => 'MOHAMEDMOHAMED@gmail.com',
                //password
            ]);
             //Log::info($response->getContent());


     }


    /** @test */
    public function user_login()
    {
        $user = factory(User::class)->create
        ([
            'email'=>'testuser@email.com',
            'password'=>bcrypt('passwordtest')
        ]);

        $response = $this->json('POST','api/login',[
            "email" => "testuser@email.com",
            "password"  => "passwordtest"
        ],['Accept' => 'application/json']);
       // dd($response->getContent());
        $response->assertStatus(200)
                 ->assertJsonStructure([
                    'name','email','profile_img'
                ]);
    }

    /** @test */
    public function details()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['view-tasks']
        );
        $this->create('User');
        $this->json('GET','api/user')
              ->assertStatus(200)
              ->assertJsonStructure([
                  'user'=>[
                    'name','email','profile_img'
                  ]
              ]);
    }

    /** @test */
    public function get_unread_notifications(){
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['view-tasks']
        );
        factory(DatabaseNotification::class)->create([ "type" => "Namespace\ClassNameOfNotification",
        "notifiable_type" => "App/Http/Models/User",
        "notifiable_id" => random_int(8888, 9999), // id of the notifiable model
        "data" => [
            "comment"=> "hello every body",
            'post'  => 'how are you'
        ]]);

        $comment = factory(Comment::class)->create();
        $post    = factory(Post::class)->create();
        $notifications = new NotifyOwner($comment,$post); //
      // dd($notifications);

        $user =factory(User::class)->create();   //here not use $user=create('User') because you want send object to constructor not array of object
        //dd($user->unreadNotifications);
        $this->json('GET','api/getAllNotifications')
                ->assertStatus(200);

    }

    /** @test */
    public function get_all_notifications(){
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['view-tasks']
        );
        factory(DatabaseNotification::class)->create([ "type" => "Namespace\ClassNameOfNotification",
        "notifiable_type" => "App\Http\Models\User",
        "notifiable_id" => random_int(8888, 9999), // id of the notifiable model
        "data" => [
            "comment"=> "hello every body",
            'post'  => 'how are you'
        ]]);  //
       // dd($not);

        $user =factory(User::class)->create();   //here not use $user=create('User') because you want send object to constructor not array of object
      //  dd($user->notifications);
        $this->json('GET','api/getAllNotifications')
                ->assertStatus(200);

    }


}
