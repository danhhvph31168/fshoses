<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->words(3, true), 
            'img_thumbnail' => $this->faker->imageUrl(640, 480, 'products', true), 
            'price_regular' => $this->faker->randomFloat(2, 100, 1000), 
            'price_sale' => $this->faker->optional()->randomFloat(2, 50, 900), 
            'views' => $this->faker->numberBetween(0, 10000), 
            'description' => $this->faker->paragraph, 
            'is_active' => $this->faker->boolean(80), 
            'is_hot_deal' => $this->faker->boolean(20), 
            'is_show_home' => $this->faker->boolean(50), 
            'is_delete' => $this->faker->boolean(10), 
        ];
    }
}
