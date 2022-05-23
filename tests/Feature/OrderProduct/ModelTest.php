<?php

namespace Tests\Feature\OrderProduct;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_product()
    {
        Order::factory()->create();
        $product = Product::factory()->create();
        $orderProduct = OrderProduct::factory()->create(['product_id' => $product->id]);

        $result = $orderProduct->product()->first()->toArray();

        unset($result['deleted_at']);

        $this->assertEquals($product->toArray(), $result);
    }

    public function test_can_get_order()
    {
        Product::factory()->create();
        $order = Order::factory()->create();
        $orderProduct = OrderProduct::factory()->create(['order_id' => $order->id]);

        $this->assertEquals($order->toArray(), $orderProduct->order()->first()->toArray());
    }
}
