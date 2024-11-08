<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'role_id' => Role::inRandomOrder()->first()->id,
            'sku_order' => $this->faker->unique()->regexify('SKU-[A-Z0-9]{8}'), // Mã SKU ngẫu nhiên
            'user_name' => $this->faker->name(),
            'user_email' => $this->faker->unique()->safeEmail(),
            'user_phone' => $this->faker->phoneNumber(),
            'user_address' => $this->faker->address(),
            'user_note' => $this->faker->sentence(),
            'status_order' => $this->faker->randomElement(['Chờ xác nhận', 'Đã xác nhận', 'Đang xử lý', 'Đang vận chuyển', 'Đã giao hàng', 'Đơn hàng đã bị hủy', 'Đã hoàn tiền', 'Thất bại']),
            'status_payment' => $this->faker->randomElement(['Chưa thanh toán', 'Đang chờ thanh toán', 'Đã thanh toán', 'Đã hoàn tiền', 'Thanh toán thất bại',]),
            'total_amount' => $this->faker->randomFloat(2, 50, 1000), // Số tiền ngẫu nhiên từ 50 đến 1000
        ];
    }
}
