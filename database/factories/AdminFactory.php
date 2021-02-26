<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Http\Models\Admin;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name'                  =>  $faker->name,
        'email'                 =>  $faker->unique()->safeEmail,
        'email_verified_at'     =>  now(),
        'password'              =>  $faker->password,
       // 'profile_img'           =>  $faker->image,
        'remember_token'        =>  Str::random(10),
        'created_at'            =>  now(),
        'updated_at'            =>  now(),
    ];
});
