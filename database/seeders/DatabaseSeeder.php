<?php

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Carlos Villatoro',
            'email' => 'c@admin.com',
            'password' => bcrypt('admin123')
        ]);

        Posts::create([
            'title' => 'Post #1',
            'content' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.',
        ]);

        Posts::create([
            'title' => 'Post #2',
            'content' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.',
        ]);

        Posts::factory(100)->create();
    }
}
