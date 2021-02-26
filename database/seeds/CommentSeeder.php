<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Http\Models\Comment::create([
            'body'=>'yes of course',
            'user_id'=>1,
            'post_id'=>1,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>2,
            'post_id'=>1,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'yes of course',
            'user_id'=>1,
            'post_id'=>2,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>2,
            'post_id'=>2,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'yes of course',
            'user_id'=>3,
            'post_id'=>3,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>3,
            'post_id'=>3,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'yes of course',
            'user_id'=>4,
            'post_id'=>4,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>4,
            'post_id'=>4,
        ]);

        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>2,
            'post_id'=>5,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'yes of course',
            'user_id'=>3,
            'post_id'=>6,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>10,
            'post_id'=>7,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'yes of course',
            'user_id'=>3,
            'post_id'=>6,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>10,
            'post_id'=>7,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'yes of course',
            'user_id'=>4,
            'post_id'=>8,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>4,
            'post_id'=>8,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>4,
            'post_id'=>9,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'yes of course',
            'user_id'=>4,
            'post_id'=>8,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>4,
            'post_id'=>10,
        ]);
        \App\Http\Models\Comment::create([
            'body'=>'i agree with you',
            'user_id'=>2,
            'post_id'=>10,
        ]);


    }
}
