<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'parent_id' => Category::inRandomOrder()->first()->id ?? null,  // Chọn ngẫu nhiên một category cha hoặc null nếu chưa có
            'name' => $this->faker->unique()->word(),  // Tạo tên category ngẫu nhiên và đảm bảo duy nhất
        ];
    }
}
