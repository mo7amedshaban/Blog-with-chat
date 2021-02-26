<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Http\Models\Category::create([
            'name'=>'Policy',
            'slug'=>'policy',
          ]);
          \App\Http\Models\Category::create([
            'name'=>'Religion',
            'slug'=>'religion',
          ]);
          \App\Http\Models\Category::create([
            'name'=>'Sport',
            'slug'=>'sport',
          ]);
          \App\Http\Models\Category::create([
            'name'=>'Culture',
            'slug'=>'culture',
          ]);
          \App\Http\Models\Category::create([
            'name'=>'COVID-19',
            'slug'=>'COVID-19',
          ]);
    }
}
