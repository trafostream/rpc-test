<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::factory()->count(3)->create()->each(function ($page){
            $page->fields()->saveMany(Field::factory()->count(rand(2, 10))->make());
        });

    }
}
