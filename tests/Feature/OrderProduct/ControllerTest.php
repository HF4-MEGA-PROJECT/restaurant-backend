<?php

namespace Tests\Feature\OrderProduct;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_products_can_be_fetched_when_one_order_product_exist()
    {
        OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('order_product.index'));

        $orderProducts = OrderProduct::all();

        $response->assertExactJson($orderProducts->toArray());
    }

    public function test_order_products_can_be_fetched_when_some_order_products_exist()
    {
        OrderProduct::factory()->create();
        OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('order_product.index'));

        $orderProducts = OrderProduct::all();

        $response->assertExactJson($orderProducts->toArray());
    }

    public function test_order_products_can_be_fetched_when_no_order_products_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('order_product.index'));

        $orderProducts = OrderProduct::all();

        $response->assertExactJson($orderProducts->toArray());
    }

    public function test_order_product_can_be_created()
    {
        $product = Product::factory()->create();
        $order = Order::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('order_product.store'), [
            'price' => 123,
            'products_id' => $product->id,
            'orders_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals(123, $orderProducts->first()->price);
        $this->assertEquals($product->id, $orderProducts->first()->products_id);
        $this->assertEquals($order->id, $orderProducts->first()->orders_id);

        $response->assertExactJson($orderProducts->first()->toArray());
    }

    public function test_order_product_can_not_be_created_when_price_is_invalid()
    {
        $product = Product::factory()->create();
        $order = Order::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('order_product.store'), [
            'price' => 'ikke et tal',
            'products_id' => $product->id,
            'orders_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(0, $orderProducts);

        $response->assertStatus(422);
    }

    public function test_order_product_can_not_be_created_when_product_does_not_exist()
    {
        $order = Order::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('order_product.store'), [
            'price' => 123,
            'products_id' => 0,
            'orders_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(0, $orderProducts);

        $response->assertStatus(422);
    }

    public function test_order_product_can_not_be_created_when_order_does_not_exist()
    {
        $product = Product::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('order_product.store'), [
            'price' => 123,
            'products_id' => $product->id,
            'orders_id' => 0
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(0, $orderProducts);

        $response->assertStatus(422);
    }

    public function test_order_product_can_be_fetched()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('order_product.show', ['order_product' => OrderProduct::factory()->create()]));

        $orderProducts = OrderProduct::all();

        $response->assertExactJson($orderProducts->first()->toArray());
    }

    public function test_order_product_can_be_updated()
    {
        $product = Product::factory()->create();
        $order = Order::factory()->create();
        $orderProduct = OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('order_product.update', $orderProduct), [
            'id' => $orderProduct->id,
            'price' => 123,
            'products_id' => $product->id,
            'orders_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals(123, $orderProducts->first()->price);
        $this->assertEquals($product->id, $orderProducts->first()->products_id);
        $this->assertEquals($order->id, $orderProducts->first()->orders_id);

        $response->assertExactJson($orderProducts->first()->toArray());
    }

    public function test_order_product_can_not_be_updated_when_price_is_invalid()
    {
        $product = Product::factory()->create();
        $order = Order::factory()->create();
        $orderProduct = OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('order_product.update', $orderProduct), [
            'id' => $orderProduct->id,
            'price' => 'ikke et tal',
            'products_id' => $product->id,
            'orders_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals($orderProduct->price, $orderProducts->first()->price);
        $this->assertEquals($orderProduct->products_id, $orderProducts->first()->products_id);
        $this->assertEquals($orderProduct->orders_id, $orderProducts->first()->orders_id);

        $response->assertStatus(422);
    }

    public function test_order_product_can_not_be_updated_when_product_does_not_exist()
    {
        $order = Order::factory()->create();
        $orderProduct = OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('order_product.update', $orderProduct), [
            'id' => $orderProduct->id,
            'price' => 123,
            'products_id' => 0,
            'orders_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals($orderProduct->price, $orderProducts->first()->price);
        $this->assertEquals($orderProduct->products_id, $orderProducts->first()->products_id);
        $this->assertEquals($orderProduct->orders_id, $orderProducts->first()->orders_id);

        $response->assertStatus(422);
    }

    public function test_order_product_can_not_be_updated_when_order_does_not_exist()
    {
        $product = Product::factory()->create();
        $orderProduct = OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('order_product.update', $orderProduct), [
            'id' => $orderProduct->id,
            'price' => 123,
            'products_id' => $product->id,
            'orders_id' => 0
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals($orderProduct->price, $orderProducts->first()->price);
        $this->assertEquals($orderProduct->products_id, $orderProducts->first()->products_id);
        $this->assertEquals($orderProduct->orders_id, $orderProducts->first()->orders_id);

        $response->assertStatus(422);
    }

    public function test_order_product_can_be_deleted()
    {
        $orderProduct = OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('order_product.destroy', $orderProduct));

        $this->assertCount(0, OrderProduct::all());

        $response->assertStatus(200);
    }
}
