<?php


use Faker\Generator as Faker;
use Illuminate\Notifications\DatabaseNotification; //import this class

$factory->define(DatabaseNotification::class, function (Faker $faker) {
    return [
            'id' => $faker->uuid,//$faker->random_int(1,100),
            "type" => "Namespace\ClassNameOfNotification",
            "notifiable_type" => "App\Http\Models\User",
            "notifiable_id" => random_int(8888, 9999), // id of the notifiable model
            "data" => [
                "comment"=> "hello every body",
                'post'  => 'how are you'
            ]
    ];

});
