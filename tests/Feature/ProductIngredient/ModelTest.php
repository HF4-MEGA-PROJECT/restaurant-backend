<?php

namespace Tests\Feature\ProductIngredient;

use App\Models\Ingredient;
use App\Models\Product;
use App\Models\ProductIngredient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_product()
    {
        Ingredient::factory()->create();
        $product = Product::factory()->create();
        $product = $product->refresh();
        $productIngredient = ProductIngredient::factory()->create(['product_id' => $product->id]);
        $productIngredient = $productIngredient->refresh();

        $result = $productIngredient->product()->first()->toArray();

        $this->assertEquals($product->toArray(), $result);
    }

    public function test_can_get_ingredient()
    {
        Product::factory()->create();
        $ingredient = Ingredient::factory()->create();
        $productIngredient = ProductIngredient::factory()->create(['ingredient_id' => $ingredient->id]);

        $result = $productIngredient->ingredient()->first()->toArray();

        $this->assertEquals($ingredient->toArray(), $result);
    }
}
