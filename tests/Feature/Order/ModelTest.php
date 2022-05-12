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

    public function test_can_get_table()
    {
        $table = Group::factory()->create();

        $order = new Order(['tables_id' => $table->id]);
        $order->save();

        $table['deleted_at'] = null;

        $this->assertEquals($table->toArray(), $order->table()->first()->toArray());
    }

    public function test_can_get_products()
    {
        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $orderProduct = OrderProduct::factory()->create(['price' => 123, 'orders_id' => $order->id, 'products_id' => $product->id]);

        $result = $order->products()->first()->toArray();

        unset($result['deleted_at']);
        unset($result['pivot']);

        $this->assertEquals($product->toArray(), $result);
    }
}
