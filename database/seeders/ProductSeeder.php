<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');
        $collections = Collection::pluck('id', 'slug');

        $productsData = [
            [
                'category' => 'hoodies',
                'collection' => 'archive-04',
                'name' => 'KINETIC ARCHIVE HEAVYWEIGHT HOODIE // WASHED CHARCOAL',
                'slug' => 'kinetic-archive-heavyweight-hoodie-washed-charcoal',
                'description' => '480GSM brushed cotton fleece with pigment enzyme wash, dropped shoulders, double-lined hood, and subtle tonal chest embroidery.',
                'base_price' => 850000,
                'is_featured' => true,
                'color' => 'Washed Charcoal',
                'sku_prefix' => 'KNT-HD-CHR',
                'images' => [
                    'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1578768079052-aa76e52ff62e?auto=format&fit=crop&w=900&q=80',
                ],
                'stocks' => ['S' => 12, 'M' => 3, 'L' => 0, 'XL' => 6],
            ],
            [
                'category' => 'hoodies',
                'collection' => 'core-essentials',
                'name' => 'STUDIO BOXY ZIP HOODIE // MATTE BLACK',
                'slug' => 'studio-boxy-zip-hoodie-matte-black',
                'description' => 'Two-way metallic zipper heavyweight hoodie engineered with cropped boxy fit and structured ribbed cuffs.',
                'base_price' => 890000,
                'is_featured' => true,
                'color' => 'Matte Black',
                'sku_prefix' => 'KNT-ZH-BLK',
                'images' => [
                    'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1509942774463-acf339cf87d5?auto=format&fit=crop&w=900&q=80',
                ],
                'stocks' => ['S' => 8, 'M' => 10, 'L' => 2, 'XL' => 5],
            ],
            [
                'category' => 'tees',
                'collection' => 'archive-04',
                'name' => 'OVERSIZED GRAPHIC TEE // BONE WHITE',
                'slug' => 'oversized-graphic-tee-bone-white',
                'description' => '280GSM combed heavyweight jersey tee featuring cracked plastisol back print and thick mock-neck collar.',
                'base_price' => 420000,
                'is_featured' => true,
                'color' => 'Bone White',
                'sku_prefix' => 'KNT-TS-BNE',
                'images' => [
                    'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?auto=format&fit=crop&w=900&q=80',
                ],
                'stocks' => ['S' => 15, 'M' => 20, 'L' => 14, 'XL' => 2],
            ],
            [
                'category' => 'tees',
                'collection' => 'core-essentials',
                'name' => 'ESSENTIAL HEAVY TEE // FADED ONYX',
                'slug' => 'essential-heavy-tee-faded-onyx',
                'description' => 'Minimalist everyday heavyweight t-shirt with tonal woven hem label and relaxed boxy drape.',
                'base_price' => 380000,
                'is_featured' => false,
                'color' => 'Faded Onyx',
                'sku_prefix' => 'KNT-TS-ONX',
                'images' => [
                    'https://images.unsplash.com/photo-1503341504253-dff4815485f1?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?auto=format&fit=crop&w=900&q=80',
                ],
                'stocks' => ['S' => 10, 'M' => 12, 'L' => 9, 'XL' => 7],
            ],
            [
                'category' => 'bottoms',
                'collection' => 'archive-04',
                'name' => 'TACTICAL WIDE CARGO PANT // SAGE WASH',
                'slug' => 'tactical-wide-cargo-pant-sage-wash',
                'description' => 'Ripstop cotton utility cargo trousers with articulated knees, bellows side pockets, and toggle ankle adjusters.',
                'base_price' => 760000,
                'is_featured' => true,
                'color' => 'Sage Wash',
                'sku_prefix' => 'KNT-CG-SGE',
                'images' => [
                    'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1542272604-787c3835535d?auto=format&fit=crop&w=900&q=80',
                ],
                'stocks' => ['S' => 5, 'M' => 9, 'L' => 4, 'XL' => 0],
            ],
            [
                'category' => 'bottoms',
                'collection' => 'core-essentials',
                'name' => 'HEAVY FLEECE JOGGER // ASH GREY',
                'slug' => 'heavy-fleece-jogger-ash-grey',
                'description' => 'Relaxed straight-leg sweatpants cut from 460GSM loop-back jersey with deep zip pockets.',
                'base_price' => 640000,
                'is_featured' => false,
                'color' => 'Ash Grey',
                'sku_prefix' => 'KNT-JG-ASH',
                'images' => [
                    'https://images.unsplash.com/photo-1552902865-b72c031ac5ea?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1517438476312-10d79c077509?auto=format&fit=crop&w=900&q=80',
                ],
                'stocks' => ['S' => 11, 'M' => 14, 'L' => 8, 'XL' => 3],
            ],
            [
                'category' => 'accessories',
                'collection' => 'archive-04',
                'name' => 'NYLON UTILITY CROSSBODY BAG // JET BLACK',
                'slug' => 'nylon-utility-crossbody-bag-jet-black',
                'description' => 'Water-repellent ballistic nylon sling bag with matte metal buckle and dual weatherproof zip compartments.',
                'base_price' => 450000,
                'is_featured' => false,
                'color' => 'Jet Black',
                'sku_prefix' => 'KNT-BG-BLK',
                'images' => [
                    'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=900&q=80',
                ],
                'stocks' => ['OS' => 18],
            ],
            [
                'category' => 'accessories',
                'collection' => 'core-essentials',
                'name' => 'DISTRESSED STUDIO CAP // WASHED SLATE',
                'slug' => 'distressed-studio-cap-washed-slate',
                'description' => '6-panel unstructured cotton twill dad cap with subtle distressed brim and tonal KINETIC mark.',
                'base_price' => 260000,
                'is_featured' => false,
                'color' => 'Washed Slate',
                'sku_prefix' => 'KNT-CP-SLT',
                'images' => [
                    'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1521369909029-2afed882baee?auto=format&fit=crop&w=900&q=80',
                ],
                'stocks' => ['OS' => 25],
            ],
        ];

        foreach ($productsData as $pData) {
            $product = Product::updateOrCreate(
                ['slug' => $pData['slug']],
                [
                    'category_id' => $categories[$pData['category']],
                    'collection_id' => $collections[$pData['collection']],
                    'name' => $pData['name'],
                    'description' => $pData['description'],
                    'base_price' => $pData['base_price'],
                    'is_featured' => $pData['is_featured'],
                    'is_active' => true,
                ]
            );

            foreach ($pData['images'] as $index => $url) {
                ProductImage::updateOrCreate(
                    ['product_id' => $product->id, 'sort_order' => $index],
                    [
                        'image_url' => $url,
                        'alt_text' => $product->name . ' view ' . ($index + 1),
                        'is_primary' => $index === 0,
                    ]
                );
            }

            foreach ($pData['stocks'] as $size => $qty) {
                ProductVariant::updateOrCreate(
                    ['sku' => "{$pData['sku_prefix']}-{$size}"],
                    [
                        'product_id' => $product->id,
                        'size' => $size,
                        'color' => $pData['color'],
                        'price_adjustment' => $size === 'XL' ? 30000 : 0,
                        'stock_qty' => $qty,
                    ]
                );
            }
        }
    }
}
