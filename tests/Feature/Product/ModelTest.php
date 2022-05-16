<?php

namespace Tests\Feature\Product;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\ProductIngredient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_parent_category()
    {
        $category = new Category(['name' => 'Hovedretter', 'categories_id' => null]);
        $category->save();

        $product = new Product(['name' => 'Tigerrejesalat', 'price' => 123, 'categories_id' => $category->id]);
        $product->save();

        $this->assertEquals($category->toArray(), $product->parent_category()->first()->toArray());
    }

    public function test_can_get_ingredients()
    {
        $ingredient = Ingredient::factory()->create();
        $product = Product::factory()->create();
        ProductIngredient::factory()->create(['ingredients_id' => $ingredient->id, 'products_id' => $product->id]);

        $result = $product->ingredients()->first()->toArray();

        unset($result['deleted_at']);
        unset($result['laravel_through_key']);

        $this->assertEquals($ingredient->toArray(), $result);
    }
}
