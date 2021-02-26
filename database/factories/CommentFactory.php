<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Post;
use App\Http\Models\User;
use App\Http\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body'       => $faker->paragraph,
        'user_id'    => factory(User::class),
        'post_id'    => factory(Post::class),
        'created_at' => now() ,
        'updated_at' => now() ,

    ];
});
