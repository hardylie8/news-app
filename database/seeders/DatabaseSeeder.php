<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('create-admin');
        $this->call(NewsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(NewsHasTagSeeder::class);
    }
}
