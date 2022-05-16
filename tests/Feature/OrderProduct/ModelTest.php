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
        $product = Product::factory()->create();
        $orderProduct = OrderProduct::factory()->create(['products_id' => $product->id]);

        $result = $orderProduct->product()->first()->toArray();

        unset($result['deleted_at']);

        $this->assertEquals($product->toArray(), $result);
    }

    public function test_can_get_order()
    {
        $order = Order::factory()->create();
        $orderProduct = OrderProduct::factory()->create(['orders_id' => $order->id]);

        $this->assertEquals($order->toArray(), $orderProduct->order()->first()->toArray());
    }
}
