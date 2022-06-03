<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_group()
    {
        $group = Group::factory()->create();

        $order = new Order(['group_id' => $group->id]);
        $order->save();

        $group['deleted_at'] = null;

        $this->assertEquals($group->toArray(), $order->group()->first()->toArray());
    }

    public function test_can_get_products()
    {
        $order = Order::factory()->create();
        $order = $order->refresh();
        $product = Product::factory()->create();
        $product = $product->refresh();
        $orderProduct = OrderProduct::factory()->create(['price_at_purchase' => 123, 'order_id' => $order->id, 'product_id' => $product->id]);
        $orderProduct = $orderProduct->refresh();

        $result = $order->products()->first()->toArray();

        $expectedProduct = $product->toArray();
        $expectedProduct['pivot'] = [
          'id' => $orderProduct->id,
          'order_id' => $order->id,
          'product_id' => $product->id,
          'price_at_purchase' => $orderProduct->price_at_purchase,
          'status' => $orderProduct->status,
          'created_at' => $orderProduct->toArray()['created_at'],
          'updated_at' => $orderProduct->toArray()['updated_at']
        ];

        $this->assertEquals($expectedProduct, $result);
    }
}
