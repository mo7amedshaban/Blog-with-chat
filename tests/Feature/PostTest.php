<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Models\Post;
use App\Http\Models\Comment;
use App\Http\Models\Category;
use Illuminate\Support\Facades\Log;

use Illuminate\Foundation\Testing\RefreshDatabase;


class PostTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    // Given
    // when
    // then

        /** @test */
        public function index_posts(){
            $user  = $this->create('User');
            $category = $this->create('Category');
            # create post  --> frogin key for  user ,category table by factory created too
            $post  = $this->create('Post',['user_id'=>$user[0]['id'],'category_id'=>$category[0]['id']]);

            $this->create('Comment',['post_id'=>$post[0]['id'],'user_id'=>$user[0]['id']]);

            $response = $this->json('GET','api/posts');
            $response->assertStatus(200)
                    ->assertJsonStructure([
                        'data'=>[
                            '*'=>[
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
                            //meta data created by default not check it
                            //'links' =>['first','last','prev','next'],
                           // 'meta'  =>['current_page','last_page','from','to','path','per_page','total']
                            ]
                    ]);
                   // Log::info($response->getContent());

        }
        /** @test */
    public function show_posts(){
        $post = $this->create('Post');
        $this->json('GET','api/posts/'.$post[0]['slug'])
             ->assertStatus(200)
             ->assertJsonStructure([
                        '*'=>[
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
                        ]
             ]);
    }

         /** @test */
    public function category_posts(){
        $user  = $this->create('User');
        $category = $this->create('Category');
        # create post  --> frogin key for  user ,category table by factory created too
        $post  = $this->create('Post',['user_id'=>$user[0]['id'],'category_id'=>$category[0]['id']]);

        $this->create('Comment',['post_id'=>$post[0]['id'],'user_id'=>$user[0]['id']]);

        $response = $this->getJson('api/category/'.$category[0]['slug'].'/posts')
                ->assertStatus(200)
                // dd($response);
                ->assertJsonStructure([
                    '*'=>[
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
                    ]

                ]);
    }
    /** @test */
    public function search_posts(){     //her not use test
        $post = $this->create('Post');
        $this->getJson('api/searchposts/'.$post[0]['title'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'=>[
                    '*'=>[
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
                    ]
                 ]
            ]);
    }
}










//,array_merge($post->toArray(),$category->toArray())
