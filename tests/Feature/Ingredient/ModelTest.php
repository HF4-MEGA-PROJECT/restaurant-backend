<?php

namespace Tests\Feature\Ingredient;

use App\Models\Ingredient;
use App\Models\Product;
use App\Models\ProductIngredient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_products()
    {
        $ingredient = Ingredient::factory()->create();
        $ingredient = $ingredient->refresh();
        $product = Product::factory()->create();
        $product = $product->refresh();
        ProductIngredient::factory()->create(['ingredient_id' => $ingredient->id, 'product_id' => $product->id]);

        $result = $ingredient->products()->first()->toArray();

        $expectedProduct = $product->toArray();
        $expectedProduct['pivot'] = [
            'ingredient_id' => $ingredient->id,
            'product_id' => $product->id
        ];

        $this->assertEquals($expectedProduct, $result);
    }
}
