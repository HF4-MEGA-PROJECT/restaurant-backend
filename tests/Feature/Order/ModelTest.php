<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use App\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_table()
    {
        $table = Table::factory()->create();

        $order = new Order(['tables_id' => $table->id]);
        $order->save();

        $table['deleted_at'] = null;

        $this->assertEquals($table->toArray(), $order->table()->first()->toArray());
    }
}
