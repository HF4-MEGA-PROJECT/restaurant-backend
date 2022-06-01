<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_can_be_fetched_when_one_product_exist()
    {
        Product::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('product.index'));

        $products = Product::all();

        $response->assertExactJson($products->toArray());
    }

    public function test_products_can_be_fetched_when_some_products_exist()
    {
        Product::factory()->create();
        Product::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('product.index'));

        $products = Product::all();

        $response->assertExactJson($products->toArray());
    }

    public function test_products_can_be_fetched_when_no_products_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('product.index'));

        $products = Product::all();

        $response->assertExactJson($products->toArray());
    }

    public function test_product_can_be_created()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('product.store'), [
            'name' => 'Tigerrejesalat',
            'description' => 'En anretning med rejer, tiger, salat.',
            'price' => 123,
            'category_id' => null,
            'photo_path' => null,
        ]);

        $products = Product::all();

        $this->assertCount(1, $products);
        $this->assertEquals('Tigerrejesalat', $products->first()->name);
        $this->assertEquals('En anretning med rejer, tiger, salat.', $products->first()->description);
        $this->assertEquals(123, $products->first()->price);
        $this->assertEquals(null, $products->first()->category_id);

        $expected = $products->first()->toArray();

        $response->assertExactJson($expected);
    }

    public function test_product_can_not_be_created_when_name_exceeds_max_length()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('product.store'), [
            'name' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
            'price' => 123,
            'category_id' => null
        ]);

        $products = Product::all();

        $this->assertCount(0, $products);

        $response->assertStatus(422);
    }

    public function test_product_can_not_be_created_when_price_is_invalid()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('product.store'), [
            'name' => 'Tigerrejesalat',
            'price' => 'ikke et tal',
            'category_id' => null
        ]);

        $products = Product::all();

        $this->assertCount(0, $products);

        $response->assertStatus(422);
    }

    public function test_product_can_not_be_created_when_parent_category_does_not_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('product.store'), [
            'name' => 'Tigerrejesalat',
            'price' => 123,
            'category_id' => 1
        ]);

        $products = Product::all();

        $this->assertCount(0, $products);

        $response->assertStatus(422);
    }

    public function test_product_can_be_fetched()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('product.show', ['product' => Product::factory()->create()]));

        $products = Product::all();

        $response->assertExactJson($products->first()->toArray());
    }

    public function test_product_can_be_updated()
    {
        $product = Product::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('product.update', $product), [
            'id' => $product->id,
            'name' => 'Tigerrejesalat',
            'description' => 'En anretning med rejer, tiger, salat.',
            'price' => 123,
            'category_id' => null,
            'photo_path' => null,
        ]);

        $products = Product::all();

        $this->assertCount(1, $products);
        $this->assertEquals('Tigerrejesalat', $products->first()->name);
        $this->assertEquals('En anretning med rejer, tiger, salat.', $products->first()->description);
        $this->assertEquals(123, $products->first()->price);
        $this->assertEquals(null, $products->first()->category_id);

        $response->assertExactJson($products->first()->toArray());
    }

    public function test_product_can_not_be_updated_when_name_exceeds_max_length()
    {
        $product = Product::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('product.update', $product), [
            'id' => $product->id,
            'name' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
            'price' => 123,
            'category_id' => null
        ]);

        $products = Product::all();

        $this->assertCount(1, $products);
        $this->assertEquals($product->name, $products->first()->name);
        $this->assertEquals($product->price, $products->first()->price);
        $this->assertEquals($product->category_id, $products->first()->category_id);

        $response->assertStatus(422);
    }

    public function test_product_can_not_be_updated_when_price_is_invalid()
    {
        $product = Product::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('product.update', $product), [
            'id' => $product->id,
            'name' => 'Tigerrejesalat',
            'price' => 'ikke et tal',
            'category_id' => null
        ]);

        $products = Product::all();

        $this->assertCount(1, $products);
        $this->assertEquals($product->name, $products->first()->name);
        $this->assertEquals($product->price, $products->first()->price);
        $this->assertEquals($product->category_id, $products->first()->category_id);

        $response->assertStatus(422);
    }

    public function test_product_can_not_be_updated_when_parent_category_does_not_exist()
    {
        $product = Product::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('product.update', $product), [
            'id' => $product->id,
            'name' => 'Tigerrejesalat',
            'price' => 123,
            'category_id' => 0
        ]);

        $products = Product::all();

        $this->assertCount(1, $products);
        $this->assertEquals($product->name, $products->first()->name);
        $this->assertEquals($product->price, $products->first()->price);
        $this->assertEquals($product->category_id, $products->first()->category_id);

        $response->assertStatus(422);
    }

    public function test_category_can_be_deleted()
    {
        $product = Product::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('product.destroy', $product));

        $this->assertCount(0, Product::all());

        $response->assertStatus(200);
    }
}
