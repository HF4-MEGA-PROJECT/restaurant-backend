<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_orders_can_be_fetched_when_one_order_exist()
    {
        Order::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('order.index'));

        $orders = Order::all();

        $response->assertExactJson($orders->toArray());
    }

    public function test_orders_can_be_fetched_when_some_orders_exist()
    {
        Order::factory()->create();
        Order::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('order.index'));

        $orders = Order::all();

        $response->assertExactJson($orders->toArray());
    }

    public function test_orders_can_be_fetched_when_no_orders_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('order.index'));

        $orders = Order::all();

        $response->assertExactJson($orders->toArray());
    }

    public function test_order_can_be_created()
    {
        $group = Group::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('order.store'), [
            'groups_id' => $group->id
        ]);

        $orders = Order::all();

        $this->assertCount(1, $orders);
        $this->assertEquals($group->id, $orders->first()->groups_id);

        $response->assertExactJson($orders->first()->toArray());
    }

    public function test_order_can_not_be_created_when_group_does_not_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('order.store'), [
            'groups_id' => 0
        ]);

        $orders = Order::all();

        $this->assertCount(0, $orders);

        $response->assertStatus(422);
    }

    public function test_order_can_be_fetched()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('order.show', ['order' => Order::factory()->create()]));

        $orders = Order::all();

        $response->assertExactJson($orders->first()->toArray());
    }

    public function test_order_can_be_updated()
    {
        $group = Group::factory()->create();
        $order = Order::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('order.update', $order), [
            'id' => $order->id,
            'groups_id' => $group->id
        ]);

        $orders = Order::all();

        $this->assertCount(1, $orders);
        $this->assertEquals($group->id, $orders->first()->groups_id);

        $response->assertExactJson($orders->first()->toArray());
    }

    public function test_order_can_not_be_updated_when_group_does_not_exist()
    {
        $order = Order::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('order.update', $order), [
            'groups_id' => null
        ]);

        $orders = Order::all();

        $this->assertCount(1, $orders);
        $this->assertEquals($order->groups_id, $orders->first()->groups_id);

        $response->assertStatus(422);
    }

    public function test_group_can_be_deleted()
    {
        $order = Order::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('order.destroy', $order));

        $this->assertCount(0, Order::all());

        $response->assertStatus(200);
    }
}
