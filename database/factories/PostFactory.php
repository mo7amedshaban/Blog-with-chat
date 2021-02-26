<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Post;
use App\Http\Models\User;
use App\Http\Models\Category;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'      =>    $faker->title,
        'slug'       =>    $faker->slug,
        'body'       =>    $faker->paragraph,
        'image'      =>    $faker->image('public/img/',400,300),
        'user_id'    =>    factory(User::class),
        'category_id'=>    factory(Category::class),
        'created_at' =>    now(),
        'updated_at' =>    now(),

    ];
});
