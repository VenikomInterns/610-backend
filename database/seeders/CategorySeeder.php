<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Category::query()->create([
            'name' => 'category 1'
        ]);

        Category::query()->create([
            'name' => 'category 2'
        ]);

        Category::query()->create([
            'name' => 'category 3'
        ]);

        Category::query()->create([
            'name' => 'category 4'
        ]);

        Category::query()->create([
            'name' => 'category 5'
        ]);
    }
}
