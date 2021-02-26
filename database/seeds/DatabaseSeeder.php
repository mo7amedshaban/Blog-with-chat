<?php

use Illuminate\Database\Seeder;
use Illuminate\Notifications\DatabaseNotification;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //  $this->call(UserSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(CategorySeeder::class);
         $this->call(PostSeeder::class);
         $this->call(CommentSeeder::class);
         $this->call(SettingSeeder::class);
         $this->call(AdminSeeder::class);
         $this->call(NotificationSeeder::class);
    }
}
