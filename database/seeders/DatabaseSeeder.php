<?php

namespace Database\Seeders;

use App\Models\{ProductVariant, ProductGallery, Product, ProductSize, ProductColor};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();

        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();

        $size = ['27', '28', '29', '30', '31'];
        foreach ($size as $item) {
            ProductSize::query()->create([
                'name' => $item
            ]);
        }

        $color = ['#0066FF', '#33FFFF', '#FF0000', '#000000', '#FFFF00'];
        foreach ($color as $item) {
            ProductColor::query()->create([
                'name' => $item
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $name = fake()->text(50);
            Product::query()->create([
                'category_id' => 1,
                'brand_id' => 1,
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(8) . $i,
                'img_thumbnail' => 'https://anhdephd.vn/wp-content/uploads/2022/04/anh-gai-xinh-hot-girl-viet-nam.jpg',
                'price_regular' => 600000,
                'price_sale' => 500000,
            ]);
        }

        for ($i = 1; $i < 21; $i++) {
            ProductGallery::query()->insert([
                [
                    'product_id' => $i,
                    'image' => 'https://anhdephd.vn/wp-content/uploads/2022/04/anh-gai-xinh-hot-girl-viet-nam.jpg',
                ],
                [
                    'product_id' => $i,
                    'image' => 'https://anhdephd.vn/wp-content/uploads/2022/04/anh-gai-xinh-hot-girl-viet-nam.jpg',
                ],
            ]);
        }

        for ($productID = 1; $productID < 21; $productID++) {
            $data = [];
            for ($sizeID = 1; $sizeID < 6; $sizeID++) {
                for ($colorID = 1; $colorID < 6; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quantity' => 100,
                        'image' => 'https://anhdephd.vn/wp-content/uploads/2022/04/anh-gai-xinh-hot-girl-viet-nam.jpg',
                    ];
                }
            }
            DB::table('product_variants')->insert($data);
        }
    }
}
