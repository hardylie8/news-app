<?php

namespace Database\Seeders;

use App\Models\NewsHasTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsHasTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsHasTag::factory(5)->create();
    }
}
