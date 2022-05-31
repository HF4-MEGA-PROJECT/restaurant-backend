<?php

namespace Tests\Feature\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_groups_can_be_fetched_when_one_group_exist()
    {
        Group::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('group.index'));

        $groups = Group::all();

        $response->assertExactJson($groups->toArray());
    }

    public function test_groups_can_be_fetched_when_some_groups_exist()
    {
        Group::factory()->create();
        Group::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('group.index'));

        $groups = Group::all();

        $response->assertExactJson($groups->toArray());
    }

    public function test_groups_can_be_fetched_when_no_groups_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('group.index'));

        $groups = Group::all();

        $response->assertExactJson($groups->toArray());
    }

    public function test_group_can_be_created()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('group.store'), [
            'amount_of_people' => 2
        ]);

        $groups = Group::all();

        $this->assertCount(1, $groups);
        $this->assertEquals(2, $groups->first()->amount_of_people);

        $expected = $groups->first()->toArray();

        $response->assertExactJson($expected);
    }

    public function test_group_can_not_be_created_with_invalid_amount_of_people()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('group.store'), [
            'amount_of_people' => 0
        ]);

        $groups = Group::all();

        $this->assertCount(0, $groups);

        $response->assertStatus(422);
    }

    public function test_group_can_be_fetched()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('group.show', ['group' => Group::factory()->create()]));

        $groups = Group::all();

        $response->assertExactJson($groups->first()->toArray());
    }

    public function test_group_can_be_updated()
    {
        $group = Group::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('group.update', $group), [
            'id' => $group->id,
            'amount_of_people' => 2
        ]);

        $groups = Group::all();

        $this->assertCount(1, $groups);
        $this->assertEquals(2, $groups->first()->amount_of_people);
        $this->assertEquals($group->number, $groups->first()->number);

        $response->assertExactJson($groups->first()->toArray());
    }

    public function test_group_can_not_be_updated_with_invalid_amount_of_people()
    {
        $group = Group::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('group.update', $group), [
            'amount_of_people' => 0
        ]);

        $groups = Group::all();

        $this->assertCount(1, $groups);
        $this->assertEquals($group->amount_of_people, $groups->first()->amount_of_people);
        $this->assertEquals($group->number, $groups->first()->number);

        $response->assertStatus(422);
    }

    public function test_group_can_be_deleted()
    {
        $group = Group::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('group.destroy', $group));

        $this->assertCount(0, Group::all());

        $response->assertStatus(200);
    }
}
