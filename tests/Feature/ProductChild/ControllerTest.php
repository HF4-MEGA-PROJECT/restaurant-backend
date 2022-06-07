<?php

namespace Tests\Feature\ProductChild;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_fetched_when_one_product_exist(){
        $category = Category::factory()->create();
        Product::factory()->create(['category_id' => $category->id]);
        $this->actingAs($user = User::factory()->create());
        $response = $this->getJson(route('category.products.index', $category));
        $products = $category->products()->get();
        $response->assertExactJson($products->toArray());
    }


    public function test_products_can_be_fetched_when_some_products_exist()
    {
        $category = Category::factory()->create();
        Product::factory()->create(['category_id' => $category->id]);
        Product::factory()->create(['category_id' => $category->id]);
        Product::factory()->create(['category_id' => $category->id]);
        Product::factory()->create();
        Product::factory()->create();
        Product::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('category.products.index', $category));

        $products = $category->products()->get();

        $response->assertExactJson($products->toArray());
    }


    public function test_categories_can_be_fetched_when_no_sub_categories_exist()
    {
        $category = Category::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('category.products.index', $category));

        $products = $category->products()->get();

        $response->assertExactJson($products->toArray());
    }


}
