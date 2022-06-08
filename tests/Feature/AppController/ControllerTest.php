<?php

namespace Tests\Feature\AppController;

use App\Enums\OrderProductStatus;
use App\Enums\ProductTypes;
use App\Models\Group;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_orders_can_be_fetched_when_one_order_is_ordered(): void {
        $this->markTestSkipped('Not implemented');
        return;

        $product = Product::factory()->create(['type' => ProductTypes::FOOD->value]);
        $product->refresh();
        $order = Order::factory()->create();
        $order->refresh();
        OrderProduct::factory()->create(['status' => OrderProductStatus::ORDERED->value, 'product_id' => Product::factory()->create(['type' => ProductTypes::DRINKS->value])->id, 'order_id' => $order->id]);
        OrderProduct::factory()->create(['status' => OrderProductStatus::ORDERED->value, 'product_id' => Product::factory()->create(['type' => ProductTypes::SNACKS->value])->id, 'order_id' => $order->id]);
        $order_product = OrderProduct::factory()->create(['status' => OrderProductStatus::ORDERED->value, 'product_id' => $product->id, 'order_id' => $order->id]);
        $order_product->refresh();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson('/api/orders/kitchen');

        $expectedProduct = $product->toArray();
        $expectedProduct['pivot'] = [
            'id' => $order_product->id,
            'order_id' => $order->id,
            'price_at_purchase' => $order_product->price_at_purchase,
            'product_id' => $product->id,
            'status' => $order_product->status,
            'created_at' => $order_product->toArray()['created_at'],
            'updated_at' => $order_product->toArray()['updated_at']
        ];

        $expectedOrder = $order;
        $expectedOrder['products'] = [
            $expectedProduct
        ];

        $expected = [
            $expectedOrder
        ];

        $result=array_diff(json_decode($response->json(), false), $expected);
        dd($result);

        $response->assertExactJson($expected);
    }

    public function test_orders_can_be_fetched_when_one_order_is_in_progress(): void {
        $this->markTestSkipped('Not implemented');
        return;

        $product = Product::factory()->create();
        $product->refresh();
        $order = Order::factory()->create();
        $order->refresh();
        $order_product = OrderProduct::factory()->create(['status' => OrderProductStatus::IN_PROGRESS->value]);
        $order_product->refresh();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson('/api/orders');

        $expectedProduct = $product->toArray();
        $expectedProduct['pivot'] = [
            'id' => $order_product->id,
            'order_id' => $order->id,
            'price_at_purchase' => $order_product->price_at_purchase,
            'product_id' => $product->id,
            'status' => $order_product->status,
            'created_at' => $order_product->toArray()['created_at'],
            'updated_at' => $order_product->toArray()['updated_at']
        ];

        $expectedOrder = Order::all()->toArray()[0];
        $expectedOrder['products'] = [
            $expectedProduct
        ];

        $expected = [
            $expectedOrder
        ];

        $response->assertExactJson($expected);
    }

    public function test_orders_can_be_fetched_when_one_order_is_deliverable(): void {
        $this->markTestSkipped('Not implemented');
        return;

        $product = Product::factory()->create();
        $product->refresh();
        $order = Order::factory()->create();
        $order->refresh();
        $order_product = OrderProduct::factory()->create(['status' => OrderProductStatus::DELIVERABLE->value]);
        $order_product->refresh();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson('/api/orders');

        $expected = [];

        $response->assertExactJson($expected);
    }

    public function test_group_orders_only_fetch_specific_group(): void {
        $this->markTestSkipped('Not implemented');
        return;

        $product = Product::factory()->create();
        $product->refresh();
        $group = Group::factory()->create();
        $group->refresh();
        $order = Order::factory()->create(['group_id' => $group->id]);
        Order::factory()->create();
        $order_product = OrderProduct::factory()->create(['order_id' => $order->id, 'status' => OrderProductStatus::IN_PROGRESS->value]);
        $order_product->refresh();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson('/api/group/' . $group->id . '/orders');

        $expectedProduct = $product->toArray();
        $expectedProduct['pivot'] = [
            'id' => $order_product->id,
            'order_id' => $order->id,
            'price_at_purchase' => $order_product->price_at_purchase,
            'product_id' => $product->id,
            'status' => $order_product->status,
            'created_at' => $order_product->toArray()['created_at'],
            'updated_at' => $order_product->toArray()['updated_at']
        ];

        $expectedOrder = $order->toArray();
        $expectedOrder['products'] = [
            $expectedProduct
        ];

        $expected = [
            $expectedOrder
        ];

        $response->assertExactJson($expected);
    }
}
