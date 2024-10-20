<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'role_id' => Role::factory(), // Tạo một role mới hoặc có thể thay thế bằng một role ID cụ thể
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Mật khẩu mặc định
            'avatar' => $this->faker->imageUrl(), // URL hình ảnh ngẫu nhiên
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'balance' => $this->faker->randomFloat(2, 0, 10000), // Số dư tài khoản ngẫu nhiên từ 0 đến 10,000
            'district' => $this->faker->city, // Quận / Huyện
            'province' => $this->faker->state, // Tỉnh / TP
            'zip_code' => $this->faker->postcode,
            'remember_token' => Str::random(10),
        ];
    }
}
