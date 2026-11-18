<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $collections = [
            [
                'name' => 'ARCHIVE DROP 04',
                'slug' => 'archive-04',
                'description' => 'Heavyweight 480GSM garment-dyed fleeces, washed boxy silhouettes, and industrial utility wear.',
                'hero_image_url' => 'https://images.unsplash.com/photo-1523398002811-999ca8dec234?auto=format&fit=crop&w=1600&q=80',
                'is_active' => true,
                'launched_at' => now()->subDays(3),
            ],
            [
                'name' => 'CORE ESSENTIALS',
                'slug' => 'core-essentials',
                'description' => 'Monochromatic everyday staples crafted for clean-cut urban layering.',
                'hero_image_url' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=1600&q=80',
                'is_active' => true,
                'launched_at' => now()->subDays(14),
            ],
        ];

        foreach ($collections as $item) {
            Collection::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
