<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->word, // Tạo mã giảm giá ngẫu nhiên
            'type' => $this->faker->randomElement(['1', '0']), // 1 là % giảm giá, 0 là giá trị giảm giá
            'value' => $this->faker->randomFloat(2, 1, 100), // Giá trị giảm giá từ 1 đến 100 với 2 chữ số thập phân
            'quantity' => $this->faker->numberBetween(0, 100), // Số lượng mã giảm giá
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'), // Ngày bắt đầu trong khoảng thời gian 1 tháng tới
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+6 months'), // Ngày kết thúc trong khoảng thời gian 6 tháng tới
        ];
    }
}