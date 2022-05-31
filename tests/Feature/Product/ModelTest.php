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
        $category = new Category(['name' => 'Hovedretter', 'category_id' => null]);
        $category->save();

        $product = new Product(['name' => 'Tigerrejesalat', 'description' => 'En anretning med rejer, tiger, salat.', 'price' => 123, 'category_id' => $category->id]);
        $product->save();

        $this->assertEquals($category->toArray(), $product->parent_category()->first()->toArray());
    }

    public function test_can_get_ingredients()
    {
        $ingredient = Ingredient::factory()->create();
        $ingredient = $ingredient->refresh();
        $product = Product::factory()->create();
        $product = $product->refresh();
        ProductIngredient::factory()->create(['ingredient_id' => $ingredient->id, 'product_id' => $product->id]);

        $expectedIngredient = $ingredient->toArray();
        $expectedIngredient['pivot'] = [
            'product_id' => $product->id,
            'ingredient_id' => $ingredient->id
        ];

        $result = $product->ingredients()->first()->toArray();

        $this->assertEquals($expectedIngredient, $result);
    }
}
