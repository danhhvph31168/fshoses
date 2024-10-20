<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Tạo user mới nếu chưa có
            'product_id' => Product::factory(), // Tạo product mới nếu chưa có
            'quantity' => $this->faker->numberBetween(1, 5), // Số lượng từ 1 đến 5
        ];
    }
}
