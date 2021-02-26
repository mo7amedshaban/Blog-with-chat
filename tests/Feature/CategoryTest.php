<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

        /** @test */
    public function get_user_categories()
    {
        # must make foregin key for relation in controller
        $this->create('Category');
        $this->create('Post',['category_id'=>1]);

        $response = $this->json('GET',route('categories.index'));

       $response->assertStatus(200)
                ->assertJsonStructure([
                    '*'   =>['id','name','slug','created_at']
                ]);
    }
}
