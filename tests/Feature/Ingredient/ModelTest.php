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
        $product = Product::factory()->create();
        ProductIngredient::factory()->create(['ingredient_id' => $ingredient->id, 'product_id' => $product->id]);

        $result = $ingredient->products()->first()->toArray();

        unset($result['deleted_at'], $result['laravel_through_key'], $result['pivot']);

        $this->assertEquals($product->toArray(), $result);
    }
}
