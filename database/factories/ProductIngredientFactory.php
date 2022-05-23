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
        $productIds = Product::pluck('id')->toArray();
        $ingredientIds = Ingredient::pluck('id')->toArray();

        return [
            'product_id' => $productIds[array_rand($productIds)],
            'ingredient_id' => $ingredientIds[array_rand($ingredientIds)],
        ];
    }
}
