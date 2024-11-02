<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        // DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        // Tag::query()->truncate();


        // Tag::factory(15)->create();


        for ($i = 25; $i < 40; $i++) {
            ProductSize::query()->create([
                'name' => $i,
            ]);
        }

        foreach (['Black', 'Grey', 'Blue', 'Gold', 'Pink', 'White'] as $item) {
            ProductColor::query()->create([
                'name' => $item,
            ]);
        }

        for ($i = 0; $i < 100; $i++) {
            $name = fake()->text(100);
            $price_regular = rand(1000000, 5000000);
            Product::query()->create([
                'category_id' => rand(6, 9),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(7) . $i,
                'img_thumbnail' => 'https://sadesign.vn/wp-content/uploads/2021/04/phong-cach-chup-anh-giay-dep-2021.jpg',
                'price_regular' =>  $price_regular,
                'price_sale' =>  $price_regular * 0.9,
            ]);
        }


        for ($i = 1; $i < 101; $i++) {
            ProductGallery::query()->insert([
                [
                    'product_id' => $i,
                    'image' => 'https://sadesign.vn/wp-content/uploads/2021/04/phong-cach-chup-anh-giay-dep-2021.jpg',
                ],
                [
                    'product_id' => $i,
                    'image' => 'https://sadesign.vn/wp-content/uploads/2021/04/phong-cach-chup-anh-giay-dep-2021.jpg',
                ]
            ]);
        }

        for ($productID = 1; $productID < 30; $productID++) {
            $data = [];
            for ($sizeID = 1; $sizeID < 5; $sizeID++) {
                for ($colorID = 1; $colorID < 7; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quantity' => 100,
                        'image' => 'https://sadesign.vn/wp-content/uploads/2021/04/phong-cach-chup-anh-giay-dep-2021.jpg'
                    ];
                }
            }
            DB::table('product_variants')->insert($data);
        }
    }
}
