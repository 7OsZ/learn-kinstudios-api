<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Hoodies', 'slug' => 'hoodies', 'sort_order' => 1],
            ['name' => 'Tees', 'slug' => 'tees', 'sort_order' => 2],
            ['name' => 'Bottoms', 'slug' => 'bottoms', 'sort_order' => 3],
            ['name' => 'Accessories', 'slug' => 'accessories', 'sort_order' => 4],
        ];

        foreach ($categories as $item) {
            Category::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'sort_order' => $item['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
