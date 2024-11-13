<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
// class ProductFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         return [
//             'category_id' => Category::factory(),
//             'name' => $this->faker->words(3, true), // Tên sản phẩm, 3 từ ngẫu nhiên
//             'img_thumbnail' => $this->faker->imageUrl(640, 480, 'products', true), // URL ảnh ngẫu nhiên
//             'price_regular' => $this->faker->randomFloat(2, 100, 1000), // Giá thường từ 100 đến 1000
//             'price_sale' => $this->faker->optional()->randomFloat(2, 50, 900), // Giá giảm có thể có hoặc không
//             'views' => $this->faker->numberBetween(0, 10000), // Lượt xem ngẫu nhiên
//             'description' => $this->faker->paragraph, // Đoạn mô tả ngẫu nhiên
//             'is_active' => $this->faker->boolean(80), // 80% khả năng là sản phẩm đang hoạt động
//             'is_hot_deal' => $this->faker->boolean(20), // 20% cơ hội là sản phẩm hot deal
//             'is_show_home' => $this->faker->boolean(50), // 50% cơ hội hiển thị ở trang chủ
//             'is_delete' => $this->faker->boolean(10), // 10% cơ hội là sản phẩm bị xoá
//         ];
//     }
// }
