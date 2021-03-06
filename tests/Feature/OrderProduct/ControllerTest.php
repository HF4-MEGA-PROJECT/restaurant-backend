<?php

namespace Tests\Feature\OrderProduct;

use App\Enums\OrderProductStatus;
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
        Order::factory()->create();
        Product::factory()->create();
        OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('order_product.index'));

        $orderProducts = OrderProduct::all();

        $response->assertExactJson($orderProducts->toArray());
    }

    public function test_order_products_can_be_fetched_when_some_order_products_exist()
    {
        Order::factory()->create();
        Product::factory()->create();
        Order::factory()->create();
        Product::factory()->create();
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
            'price_at_purchase' => 123,
            'product_id' => $product->id,
            'order_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals(123, $orderProducts->first()->price_at_purchase);
        $this->assertEquals($product->id, $orderProducts->first()->product_id);
        $this->assertEquals($order->id, $orderProducts->first()->order_id);
        $this->assertEquals(OrderProductStatus::ORDERED->value, $orderProducts->first()->status);

        $response->assertExactJson($orderProducts->first()->toArray());
    }

    public function test_order_product_can_not_be_created_when_price_is_invalid()
    {
        $product = Product::factory()->create();
        $order = Order::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('order_product.store'), [
            'price_at_purchase' => 'ikke et tal',
            'product_id' => $product->id,
            'order_id' => $order->id
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
            'price_at_purchase' => 123,
            'product_id' => 0,
            'order_id' => $order->id
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
            'price_at_purchase' => 123,
            'product_id' => $product->id,
            'order_id' => 0
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(0, $orderProducts);

        $response->assertStatus(422);
    }

    public function test_order_product_can_be_fetched()
    {
        Order::factory()->create();
        Product::factory()->create();
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
            'price_at_purchase' => 123,
            'status' => OrderProductStatus::DELIVERABLE->value,
            'product_id' => $product->id,
            'order_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals(123, $orderProducts->first()->price_at_purchase);
        $this->assertEquals($product->id, $orderProducts->first()->product_id);
        $this->assertEquals($order->id, $orderProducts->first()->order_id);
        $this->assertEquals(OrderProductStatus::DELIVERABLE->value, $orderProducts->first()->status);

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
            'price_at_purchase' => 'ikke et tal',
            'status' => OrderProductStatus::DELIVERABLE->value,
            'product_id' => $product->id,
            'order_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals($orderProduct->price_at_purchase, $orderProducts->first()->price_at_purchase);
        $this->assertEquals($orderProduct->product_id, $orderProducts->first()->product_id);
        $this->assertEquals($orderProduct->order_id, $orderProducts->first()->order_id);
        $this->assertEquals($orderProduct->status, $orderProducts->first()->status);

        $response->assertStatus(422);
    }

    public function test_order_product_can_not_be_updated_when_product_does_not_exist()
    {
        Product::factory()->create();
        $order = Order::factory()->create();
        $orderProduct = OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('order_product.update', $orderProduct), [
            'id' => $orderProduct->id,
            'price_at_purchase' => 123,
            'status' => OrderProductStatus::DELIVERABLE->value,
            'product_id' => 0,
            'order_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals($orderProduct->price_at_purchase, $orderProducts->first()->price_at_purchase);
        $this->assertEquals($orderProduct->product_id, $orderProducts->first()->product_id);
        $this->assertEquals($orderProduct->order_id, $orderProducts->first()->order_id);
        $this->assertEquals($orderProduct->status, $orderProducts->first()->status);

        $response->assertStatus(422);
    }

    public function test_order_product_can_not_be_updated_when_order_does_not_exist()
    {
        Order::factory()->create();
        $product = Product::factory()->create();
        $orderProduct = OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('order_product.update', $orderProduct), [
            'id' => $orderProduct->id,
            'price_at_purchase' => 123,
            'status' => OrderProductStatus::DELIVERABLE->value,
            'product_id' => $product->id,
            'order_id' => 0
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals($orderProduct->price_at_purchase, $orderProducts->first()->price_at_purchase);
        $this->assertEquals($orderProduct->product_id, $orderProducts->first()->product_id);
        $this->assertEquals($orderProduct->order_id, $orderProducts->first()->order_id);
        $this->assertEquals($orderProduct->status, $orderProducts->first()->status);

        $response->assertStatus(422);
    }

    public function test_order_product_can_not_be_updated_when_status_does_not_exist()
    {
        $product = Product::factory()->create();
        $order = Order::factory()->create();
        $orderProduct = OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('order_product.update', $orderProduct), [
            'id' => $orderProduct->id,
            'price_at_purchase' => 123,
            'status' => 'ikke en status',
            'product_id' => $product->id,
            'order_id' => $order->id
        ]);

        $orderProducts = OrderProduct::all();

        $this->assertCount(1, $orderProducts);
        $this->assertEquals($orderProduct->price_at_purchase, $orderProducts->first()->price_at_purchase);
        $this->assertEquals($orderProduct->product_id, $orderProducts->first()->product_id);
        $this->assertEquals($orderProduct->order_id, $orderProducts->first()->order_id);
        $this->assertEquals($orderProduct->status, $orderProducts->first()->status);

        $response->assertStatus(422);
    }

    public function test_order_product_can_be_deleted()
    {
        Order::factory()->create();
        Product::factory()->create();
        $orderProduct = OrderProduct::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('order_product.destroy', $orderProduct));

        $this->assertCount(0, OrderProduct::all());

        $response->assertStatus(200);
    }
}
