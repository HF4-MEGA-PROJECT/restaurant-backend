<?php

namespace Tests\Feature\AppController;

use App\Enums\OrderProductStatus;
use App\Models\Order;
use App\Models\Group;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_orders_can_be_fetched_when_one_order_is_ordered(): void {
        $product = Product::factory()->create();
        $product->refresh();
        $order = Order::factory()->create();
        $order->refresh();
        $order_product = OrderProduct::factory()->create(['status' => OrderProductStatus::ORDERED->value]);
        $order_product->refresh();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson('/api/orders');

        $expectedProduct = $product->toArray();
        $expectedProduct['pivot'] = [
            'order_id' => $order->id,
            'price_at_purchase' => $order_product->price_at_purchase,
            'product_id' => $product->id,
            'status' => $order_product->status
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

    public function test_orders_can_be_fetched_when_one_order_is_in_progress(): void {
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
            'order_id' => $order->id,
            'price_at_purchase' => $order_product->price_at_purchase,
            'product_id' => $product->id,
            'status' => $order_product->status
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
}
