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
        $product = Product::factory()->create();
        $orderProduct = OrderProduct::factory()->create(['price_at_purchase' => 123, 'order_id' => $order->id, 'product_id' => $product->id]);

        $result = $order->products()->first()->toArray();

        unset($result['deleted_at']);
        unset($result['pivot']);

        $this->assertEquals($product->toArray(), $result);
    }
}
