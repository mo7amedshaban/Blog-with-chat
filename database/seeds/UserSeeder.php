<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Http\Models\User::create([
            'username'=>'mohamed',
            'email'=>'mohamed@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
            'is_admin'=>true
        ]);
        \App\Http\Models\User::create([
            'username'=>'Hamam',
            'email'=>'Hamam@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
        \App\Http\Models\User::create([
            'username'=>'Khalid',
            'email'=>'Khalid@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
        \App\Http\Models\User::create([
            'username'=>'Hazem',
            'email'=>'Hazem@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
        \App\Http\Models\User::create([
            'username'=>'Sondos',
            'email'=>'Sondos@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
        \App\Http\Models\User::create([
            'username'=>'Adam',
            'email'=>'Adam@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
        \App\Http\Models\User::create([
            'username'=>'Ahmed',
            'email'=>'Ahmed@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
        \App\Http\Models\User::create([
            'username'=>'Eid',
            'email'=>'Eid@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
        \App\Http\Models\User::create([
            'username'=>'Sayed',
            'email'=>'sayed@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
        \App\Http\Models\User::create([
            'username'=>'Shaban',
            'email'=>'Shaban@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
        \App\Http\Models\User::create([
            'username'=>'Rasha',
            'email'=>'Rasha@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
        \App\Http\Models\User::create([
            'username'=>'Mahmoud',
            'email'=>'mahmoud@gmail.com',
            'password'=>bcrypt('123123'),
            'profile_img'=>'default_image.png',
            'phone' =>'01110268848',
        ]);
    }
}
