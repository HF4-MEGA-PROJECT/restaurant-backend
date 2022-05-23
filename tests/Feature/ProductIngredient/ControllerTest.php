<?php

namespace Tests\Feature\ProductIngredient;

use App\Models\Ingredient;
use App\Models\ProductIngredient;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_ingredients_can_be_fetched_when_one_product_ingredient_exist()
    {
        Ingredient::factory()->create();
        Product::factory()->create();
        ProductIngredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('product_ingredient.index'));

        $productIngredients = ProductIngredient::all();

        $response->assertExactJson($productIngredients->toArray());
    }

    public function test_product_ingredients_can_be_fetched_when_some_product_ingredients_exist()
    {
        Ingredient::factory()->create();
        Product::factory()->create();
        Ingredient::factory()->create();
        Product::factory()->create();
        ProductIngredient::factory()->create();
        ProductIngredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('product_ingredient.index'));

        $productIngredients = ProductIngredient::all();

        $response->assertExactJson($productIngredients->toArray());
    }

    public function test_product_ingredients_can_be_fetched_when_no_product_ingredients_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('product_ingredient.index'));

        $productIngredients = ProductIngredient::all();

        $response->assertExactJson($productIngredients->toArray());
    }

    public function test_product_ingredient_can_be_created()
    {
        $product = Product::factory()->create();
        $ingredient = Ingredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('product_ingredient.store'), [
            'product_id' => $product->id,
            'ingredient_id' => $ingredient->id
        ]);

        $productIngredients = ProductIngredient::all();

        $this->assertCount(1, $productIngredients);
        $this->assertEquals($product->id, $productIngredients->first()->product_id);
        $this->assertEquals($ingredient->id, $productIngredients->first()->ingredient_id);

        $response->assertExactJson($productIngredients->first()->toArray());
    }

    public function test_product_ingredient_can_not_be_created_when_product_does_not_exist()
    {
        $ingredient = Ingredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('product_ingredient.store'), [
            'product_id' => 0,
            'ingredient_id' => $ingredient->id
        ]);

        $productIngredients = ProductIngredient::all();

        $this->assertCount(0, $productIngredients);

        $response->assertStatus(422);
    }

    public function test_product_ingredient_can_not_be_created_when_ingredient_does_not_exist()
    {
        $product = Product::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('product_ingredient.store'), [
            'product_id' => $product->id,
            'ingredient_id' => 0
        ]);

        $productIngredients = ProductIngredient::all();

        $this->assertCount(0, $productIngredients);

        $response->assertStatus(422);
    }

    public function test_product_ingredient_can_be_fetched()
    {
        Ingredient::factory()->create();
        Product::factory()->create();
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('product_ingredient.show', ['product_ingredient' => ProductIngredient::factory()->create()]));

        $productIngredients = ProductIngredient::all();

        $response->assertExactJson($productIngredients->first()->toArray());
    }

    public function test_product_ingredient_can_be_updated()
    {
        $product = Product::factory()->create();
        $ingredient = Ingredient::factory()->create();
        $productIngredient = ProductIngredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('product_ingredient.update', $productIngredient), [
            'id' => $productIngredient->id,
            'product_id' => $product->id,
            'ingredient_id' => $ingredient->id
        ]);

        $productIngredients = ProductIngredient::all();

        $this->assertCount(1, $productIngredients);
        $this->assertEquals($product->id, $productIngredients->first()->product_id);
        $this->assertEquals($ingredient->id, $productIngredients->first()->ingredient_id);

        $response->assertExactJson($productIngredients->first()->toArray());
    }

    public function test_product_ingredient_can_not_be_updated_when_product_does_not_exist()
    {
        Product::factory()->create();
        $ingredient = Ingredient::factory()->create();
        $productIngredient = ProductIngredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('product_ingredient.update', $productIngredient), [
            'id' => $productIngredient->id,
            'price' => 123,
            'product_id' => 0,
            'ingredient_id' => $ingredient->id
        ]);

        $productIngredients = ProductIngredient::all();

        $this->assertCount(1, $productIngredients);
        $this->assertEquals($productIngredient->product_id, $productIngredients->first()->product_id);
        $this->assertEquals($productIngredient->ingredient_id, $productIngredients->first()->ingredient_id);

        $response->assertStatus(422);
    }

    public function test_product_ingredient_can_not_be_updated_when_ingredient_does_not_exist()
    {
        Ingredient::factory()->create();
        $product = Product::factory()->create();
        $productIngredient = ProductIngredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('product_ingredient.update', $productIngredient), [
            'id' => $productIngredient->id,
            'price' => 123,
            'product_id' => $product->id,
            'ingredient_id' => 0
        ]);

        $productIngredients = ProductIngredient::all();

        $this->assertCount(1, $productIngredients);
        $this->assertEquals($productIngredient->price, $productIngredients->first()->price);
        $this->assertEquals($productIngredient->product_id, $productIngredients->first()->product_id);
        $this->assertEquals($productIngredient->ingredient_id, $productIngredients->first()->ingredient_id);

        $response->assertStatus(422);
    }

    public function test_product_ingredient_can_be_deleted()
    {
        Ingredient::factory()->create();
        Product::factory()->create();
        $productIngredient = ProductIngredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('product_ingredient.destroy', $productIngredient));

        $this->assertCount(0, ProductIngredient::all());

        $response->assertStatus(200);
    }
}
