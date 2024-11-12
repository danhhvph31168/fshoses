<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'order_id' => Order::inRandomOrder()->first()->id,
            'product_variant_id' => ProductVariant::inRandomOrder()->first()->id,
            'quantity' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->numberBetween(10, 100),
        ];
    }
}
