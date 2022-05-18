<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductIngredient>
 */
class ProductIngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory()->create()->id,
            'ingredient_id' => Ingredient::factory()->create()->id
        ];
    }
}
