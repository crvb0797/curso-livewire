<?php

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        User::create([
            'name' => 'Carlos Villatoro',
            'email' => 'c@admin.com',
            'password' => bcrypt('admin123')
        ]);


        Posts::factory(100)->create();
    }
}
