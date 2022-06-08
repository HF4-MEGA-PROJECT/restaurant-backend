<?php

namespace Database\Factories;

use App\Enums\ProductTypes;
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
    public function definition()
    {
        return [
            'name' => $this->faker->text(255),
            'description' => $this->faker->text(1000),
            'price' => $this->faker->numberBetween(),
            'type' => ProductTypes::cases()[array_rand(ProductTypes::cases())]->value,
            'category_id' => null,
            'photo_path' => null,
        ];
    }
}
