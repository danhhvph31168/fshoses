<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),  // Tạo ngẫu nhiên Category hoặc lấy category có sẵn
            'name' => $this->faker->word(),  // Tên sản phẩm ngẫu nhiên
            'img_thumbnail' => $this->faker->imageUrl(640, 480, 'product'),  // Tạo URL hình ảnh giả cho thumbnail
            'price_regular' => $this->faker->randomFloat(2, 100, 1000),  // Giá thông thường từ 100 đến 1000
            'price_sale' => $this->faker->optional()->randomFloat(2, 50, 900),  // Giá khuyến mãi tùy chọn (có thể null)
            'views' => $this->faker->numberBetween(0, 1000),  // Số lượng view ngẫu nhiên
            'description' => $this->faker->paragraph(),  // Mô tả ngẫu nhiên
            'is_active' => $this->faker->boolean(90),  // 90% sản phẩm là active
            'is_hot_deal' => $this->faker->boolean(20),  // 20% sản phẩm là hot deal
            'is_show_home' => $this->faker->boolean(30),  // 30% sản phẩm hiện trên trang chủ
            'is_delete' => false,  // Mặc định không xóa
        ];
    }
}
