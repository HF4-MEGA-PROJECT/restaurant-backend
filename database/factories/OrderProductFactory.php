<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderProduct>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productIds = Product::pluck('id')->toArray();
        $orderIds = Order::pluck('id')->toArray();

        return [
            'price_at_purchase' => $this->faker->numberBetween(0, 150),
            'product_id' => $productIds[array_rand($productIds)],
            'order_id' => $orderIds[array_rand($orderIds)],
        ];
    }
}
