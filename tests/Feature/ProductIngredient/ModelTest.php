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
        $product = Product::factory()->create();
        $productIngredient = ProductIngredient::factory()->create(['product_id' => $product->id]);

        $result = $productIngredient->product()->first()->toArray();

        unset($result['deleted_at']);

        $this->assertEquals($product->toArray(), $result);
    }

    public function test_can_get_ingredient()
    {
        $ingredient = Ingredient::factory()->create();
        $productIngredient = ProductIngredient::factory()->create(['ingredient_id' => $ingredient->id]);

        $result = $productIngredient->ingredient()->first()->toArray();

        $this->assertEquals($ingredient->toArray(), $result);
    }
}
