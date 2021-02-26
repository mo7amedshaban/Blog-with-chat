<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$ php artisan make:migration add_is_admin_to_users_table

        # -------->  Admin  <------------
        \App\Http\Models\Admin::create([
            'name'=>'mohamed shaban',
            'email'=>'mohamed.shaban@gmail.com',
            'password'=>bcrypt('123123'),

        ]);
        \App\Http\Models\Admin::create([
            'name'=>'Hamam',
            'email'=>'Hamam@gmail.com',
            'password'=>bcrypt('123123'),

        ]);
        \App\Http\Models\Admin::create([
            'name'=>'Khalid',
            'email'=>'Khalid@gmail.com',
            'password'=>bcrypt('123123'),

        ]);
        \App\Http\Models\Admin::create([
            'name'=>'Hazem',
            'email'=>'Hazem@gmail.com',
            'password'=>bcrypt('123123'),

        ]);
        \App\Http\Models\Admin::create([
            'name'=>'Sondos',
            'email'=>'Sondos@gmail.com',
            'password'=>bcrypt('123123'),

        ]);
        \App\Http\Models\Admin::create([
            'name'=>'Adam',
            'email'=>'Adam@gmail.com',
            'password'=>bcrypt('123123'),

        ]);
    }
}
