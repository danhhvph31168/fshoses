<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Role;
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
        // for ($i = 1; $i < 3; $i++) {
        //     Role::query()->create([
        //         'name' => 'Test Role' . $i,
        //     ]);
        // }

        // \App\Models\User::factory(10)->create();

        // for ($i = 1; $i < 11; $i++) {
        //     \App\Models\User::factory()->create([
        //         'role_id'   => 4,
        //         'name'      => 'Test User',
        //         'email'     => 'v@example.com' . $i,
        //         'avatar'    => 'https://anhdephd.vn/wp-content/uploads/2022/04/anh-gai-xinh-hot-girl-viet-nam.jpg',
        //         'phone'     => '0987654321',
        //         'address'   => 'Viet Nam',
        //         'balance'   => '1234',
        //         'district'  => 'Quynh Phu',
        //         'province'  => 'Thai Binh',
        //         'zip_code'  => '3333',
        //     ]);
        // }

        // for ($i = 1; $i < 11; $i++) {
        //     Order::query()->create([
        //         'user_id'       => 7,
        //         'role_id'       => 1,
        //         'sku_order'     => 'DH' . '-' . Str::random(6),
        //         'user_name'     => 'Order' . $i,
        //         'user_email'    => 'test@example.com',
        //         'user_phone'    => '0987654321',
        //         'user_address'  => 'Thai Binh',
        //         'total_amount'  => '999999',
        //     ]);
        // }

        // Schema::disableForeignKeyConstraints();

        // ProductVariant::query()->truncate();
        // ProductGallery::query()->truncate();
        // Product::query()->truncate();
        // ProductSize::query()->truncate();
        // ProductColor::query()->truncate();


        // for ($i = 25; $i < 40; $i++) {
        //     ProductSize::query()->create([
        //         'name' => $i,
        //     ]);
        // }

        // foreach (['Black', 'Grey', 'Blue', 'Gold', 'Pink', 'White'] as $item) {
        //     ProductColor::query()->create([
        //         'name' => $item,
        //     ]);
        // }

        // for ($i = 0; $i < 50; $i++) {
        //     $name = fake()->text(100);
        //     $price_regular = rand(1000000, 5000000);
        //     Product::query()->create([
        //         'category_id' => rand(6, 9),
        //         'name' => $name,
        //         'slug' => Str::slug($name) . '-' . Str::random(8),
        //         'sku' => Str::random(7) . $i,
        //         'img_thumbnail' => 'https://sadesign.vn/wp-content/uploads/2021/04/phong-cach-chup-anh-giay-dep-2021.jpg',
        //         'price_regular' =>  $price_regular,
        //         'price_sale' =>  $price_regular * 0.9,
        //     ]);
        // }


        // for ($i = 1; $i < 21; $i++) {
        //     ProductGallery::query()->insert([
        //         [
        //             'product_id' => $i,
        //             'image' => 'https://sadesign.vn/wp-content/uploads/2021/04/phong-cach-chup-anh-giay-dep-2021.jpg',
        //         ],
        //         [
        //             'product_id' => $i,
        //             'image' => 'https://sadesign.vn/wp-content/uploads/2021/04/phong-cach-chup-anh-giay-dep-2021.jpg',
        //         ]
        //     ]);
        // }

        for ($productID = 1; $productID < 21; $productID++) {
            $data = [];
            for ($sizeID = 1; $sizeID < 16; $sizeID++) {
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
