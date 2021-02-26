<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Models\User;
use Laravel\Sanctum\Sanctum;
use App\Events\UnreadMessages;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class chat extends TestCase
{
    use RefreshDatabase;

     /** @test */
     public function test_getcontacts()
     {
         Sanctum::actingAs(
             factory(User::class)->create(),
             ['view-tasks']
         );
         $this->withoutExceptionHandling();
         Event::fake();
         $user = factory(User::class)->create();
         $response = $this->json('GET','api/contacts');

         $response->assertStatus(200);
         Event::assertDispatched(UnreadMessages::class);
     }
}
