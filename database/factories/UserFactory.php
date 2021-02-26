<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;



$factory->define(User::class, function (Faker $faker) {
    return [
        'name'                  =>  $faker->name,
        'email'                 =>  $faker->unique()->safeEmail,
        'email_verified_at'     =>  now(),
        'password'              =>  $faker->password,
        'profile_img'           =>  $faker->image,
        'remember_token'        =>  Str::random(10),
        'created_at'            =>  now(),
        'updated_at'            =>  now(),
    ];
});
