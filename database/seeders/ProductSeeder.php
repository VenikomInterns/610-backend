<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->find(1)->products()->createMany([
            [
                'name' => 'product 1',
                'price' => 200,
                'description' => 'product 1 description'
            ],
            [
                'name' => 'product 2',
                'price' => 300,
                'description' => 'product 2 description'
            ],
            [
                'name' => 'product 3',
                'price' => 400,
                'description' => 'product 3 description'
            ],
        ]);

        Category::query()->find(2)->products()->createMany([
            [
                'name' => 'product 4',
                'price' => 250,
                'description' => 'product 4 description'
            ],
            [
                'name' => 'product 5',
                'price' => 350,
                'description' => 'product 5 description'
            ],
        ]);

        Category::query()->find(3)->products()->create([
                'name' => 'product 6',
                'price' => 150,
                'description' => 'product 6 description'
        ]);
        //good
    }
}
