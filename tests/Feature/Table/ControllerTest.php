<?php

namespace Tests\Feature\Table;

use App\Models\Table;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_tables_can_be_fetched_when_one_table_exist()
    {
        Table::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('table.index'));

        $tables = Table::all();

        $response->assertExactJson($tables->toArray());
    }

    public function test_tables_can_be_fetched_when_some_tables_exist()
    {
        Table::factory()->create();
        Table::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('table.index'));

        $tables = Table::all();

        $response->assertExactJson($tables->toArray());
    }

    public function test_tables_can_be_fetched_when_no_tables_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('table.index'));

        $tables = Table::all();

        $response->assertExactJson($tables->toArray());
    }

    public function test_table_can_be_created()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('table.store'), [
            'amount_of_people' => 2,
            'number' => 'Bord 1'
        ]);

        $tables = Table::all();

        $this->assertCount(1, $tables);
        $this->assertEquals(2, $tables->first()->amount_of_people);
        $this->assertEquals('Bord 1', $tables->first()->number);

        $expected = $tables->first()->toArray();

        unset($expected['deleted_at']);

        $response->assertExactJson($expected);
    }

    public function test_table_can_not_be_created_with_invalid_amount_of_people()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('table.store'), [
            'amount_of_people' => 0,
            'number' => 'Bord 1'
        ]);

        $tables = Table::all();

        $this->assertCount(0, $tables);

        $response->assertStatus(422);
    }

    public function test_table_can_not_be_created_when_number_exceeds_max_length()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('table.store'), [
            'amount_of_people' => 2,
            'number' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
        ]);

        $tables = Table::all();

        $this->assertCount(0, $tables);

        $response->assertStatus(422);
    }

    public function test_table_can_be_fetched()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('table.show', ['table' => Table::factory()->create()]));

        $tables = Table::all();

        $response->assertExactJson($tables->first()->toArray());
    }

    public function test_table_can_be_updated()
    {
        $table = Table::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('table.update', $table), [
            'id' => $table->id,
            'amount_of_people' => 2,
            'number' => 'Bord 1'
        ]);

        $tables = Table::all();

        $this->assertCount(1, $tables);
        $this->assertEquals(2, $tables->first()->amount_of_people);
        $this->assertEquals('Bord 1', $tables->first()->number);

        $response->assertExactJson($tables->first()->toArray());
    }

    public function test_table_can_not_be_updated_with_invalid_amount_of_people()
    {
        $table = Table::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('table.update', $table), [
            'amount_of_people' => 0,
            'number' => 'Bord 1',
        ]);

        $tables = Table::all();

        $this->assertCount(1, $tables);
        $this->assertEquals($table->amount_of_people, $tables->first()->amount_of_people);
        $this->assertEquals($table->number, $tables->first()->number);

        $response->assertStatus(422);
    }

    public function test_table_can_not_be_updated_when_number_exceeds_max_length()
    {
        $table = Table::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('table.update', $table), [
            'amount_of_people' => 2,
            'number' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
        ]);

        $tables = Table::all();

        $this->assertCount(1, $tables);
        $this->assertEquals($table->amount_of_people, $tables->first()->amount_of_people);
        $this->assertEquals($table->number, $tables->first()->number);

        $response->assertStatus(422);
    }

    public function test_table_can_be_deleted()
    {
        $table = Table::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('table.destroy', $table));

        $this->assertCount(0, Table::all());

        $response->assertStatus(200);
    }
}
