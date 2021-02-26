<?php

namespace Tests\Feature\Admin;

use Faker\Factory;
use Tests\TestCase;
use App\Http\Models\Post;
use App\Http\Models\User;
use App\Http\Models\Admin;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use App\Http\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * when use log
     *  Log::info($response->getContent());
     */

    /** @test */
    public function non_authenticated(){
        $get_posts = $this->json('GET','api/admin/posts');
        $get_posts->assertStatus(401);

        $get_admin_Categories = $this->json('GET','api/admin/categories');
        $get_admin_Categories->assertStatus(401);

        $add_post = $this->json('POST','api/admin/addPost');
        $add_post->assertStatus(401);

        $update_post = $this->json('POST','api/admin/updatePost/1');
        $update_post->assertStatus(401);

        $delete_post = $this->json('POST','api/admin/deletePosts');
        $delete_post->assertStatus(401);

    }



    /** @test */
    public function get_posts()
    {
        Sanctum::actingAs(
            factory(Admin::class)->create(),
            ['view-tasks']
        );

            $this->create('Post');
            $this->create('Post');
            $this->create('Post');

            $response = $this->json('GET','api/admin/posts');
            $response->assertStatus(200)
                     ->assertJsonStructure([
                        'data'   =>[               //return array of object
                            '*'   =>[
                                'id',
                                'user_id' ,
                                'category_id' ,
                                'title' ,
                                'body' ,
                                'slug' ,
                                'image'  ,
                                'added_at' ,
                                'nbposts' ,
                                'comments_count',
                                "user"  ,
                                'category',
                                'comments',
                            ],
                        ]
                     ]);

    }

    /** @test */
    public function get_admin_categories(){
        Sanctum::actingAs(
            factory(Admin::class)->create(),
            ['view-tasks']
        );
        $this->create('Category');
        $response = $this->json('GET','api/admin/categories');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*'   =>['id','name','slug','created_at']   //return array of json
                 ]);
    }
     /** @test */
     public function validation_post(){
        Sanctum::actingAs(
            factory(Admin::class)->create(),
            ['view-tasks']
        );

        $response = $this->json('POST','api/admin/addPost',[
            'title'        =>  null,  // validation required
            'body'         =>  null,  // validation required
            'image'        =>  null,  // validation required
            'user_id'      =>  1,
            'category_id'  =>  1
        ]);
        $response->assertStatus(
           422
        );
         $response->assertJsonValidationErrors(['title','body','image']);
    }

    /** @test */
    public function add_post(){

        /**
         * slug in controller use title send title not slug   Str::Slug($reques->title);    not $request->slug
         * must use Storage::fake('public')  ,Storge::disk('public')
         * because controller use  store('$image','public')   public is driver name can use local or create new driver
         *not check image in assertJson because it get path only not name  check by storage::disk
         *public store image in path    Blog/storage/app/public/image/$file
         */
        Sanctum::actingAs(
            factory(Admin::class)->create(),
            ['view-tasks']
        );
        $user       =   factory(User::class)->create();
        $category   =   factory(Category::class)->create();

        Storage::fake('photos');

        $title        =  'hello';
        $slug         =  'ok-hello';
        $body         =  'mohamed';
        $user_id      =  $user['id'];
        $category_id  =  $category['id'];
        $file         =   UploadedFile::fake()->image('random.jpg',10,10);
        $response = $this->json('POST','api/admin/addPost',[
             'title'        =>  $title,
             'slug'         =>  $slug,
             'body'         =>  $body,
             'image'        =>  $file,
             'user_id'      =>  $user_id,
             'category_id'  =>  $category_id
        ]);

        //dd($response->getContent());
        $this->assertEquals($file->hashName(),Post::latest()->first()->image);  // test database
        Storage::disk('photos')->assertExists($file->hashName());   //test driver

        $response->assertJsonStructure([
                'id','title','slug','body','image','user_id','category_id'
            ])
            ->assertJson([
                'title'        =>  $title,
                'body'         =>  $body,
                'user_id'      =>  $user['id'],
                'category_id'  =>  $category['id'],
            ])
            ->assertStatus(201);
    }

    /** @test */
      public function update_post(){
        $this->withoutExceptionHandling();
        Sanctum::actingAs(
            factory(Admin::class)->create(),
            ['view-tasks']
        );
        $post  =   $this->create('Post');
        Storage::fake('photos');
        $file  =   UploadedFile::fake()->image('raom.jpg',10,10);

        $response = $this->json('POST','api/admin/updatePost/'.$post[0]['id'],[

             'title'        =>  $post[0]['title'].'updataed',
             'slug'         =>  $post[0]['slug'].'updataed',
             'body'         =>  $post[0]['body'].'updataed',
             'image'        =>  $file,
             'user_id'      =>  '1',  //2
             'category_id'  =>  '2',
        ]);
        //dd($response->getContent());
        $this->assertEquals($file->hashName(),Post::latest()->first()->image); //check database
        Storage::disk('photos')->assertExists($file->hashName());   //check folder in laravel path
        $response->assertStatus(200)
                 ->assertJson([
                    '0'=>[
                        'id'           =>  $post[0]['id'],
                        'title'        =>  $post[0]['title'].'updataed',
                        'body'         =>  $post[0]['body'].'updataed',
                        'user_id'      =>   '1',
                        'category_id'  =>   '2',
                    ]
                ]);
        $this->assertDatabaseHas('posts',[
                    'id'           =>  $post[0]['id'],
                    'title'        =>  $post[0]['title'].'updataed',
                    'body'         =>  $post[0]['body'].'updataed',
                    'user_id'      =>   '1',
                    'category_id'  =>   '2',
                    'image'        =>   $file->hashName(),
        ]);

    }

    /** @test */
    public function delete_post(){
        Sanctum::actingAs(
            factory(Admin::class)->create(),
            ['view-tasks']
        );
        $post = $this->create('Post');
        $post_two = $this->create('Post');
        //can send one post or many because  checkboxes in vue use single and multiple select box
        $response = $this->json('POST','api/admin/deletePosts',[
                                'posts_ids'=>[
                                    $post[0]['id'],
                                    $post_two[0]['id']
                                ]
                        ]);
        $response->assertStatus(204)
                  ->assertSee(null);
         $this->assertDatabaseMissing('posts',[
                'id'=>$post[0]['id'],
                'id'=>$post_two[0]['id']
          ]);

    }


}








