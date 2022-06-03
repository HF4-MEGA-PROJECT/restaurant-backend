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
        $product = Product::factory()->create();
        Product::factory()->create(['category_id' => $product->categories_id]);

        $this->actingAs($user = User::factory()->create());
        $response = $this->getJson(route('product.children.index', $product));
        $products = $product->sub_categories()->get();

        $response->assertExactJson($products->toArray());
    }

}
