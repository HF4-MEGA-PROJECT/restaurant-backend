<?php

namespace Tests\Feature\Ingredient;

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ingredients_can_be_fetched_when_one_ingredient_exist()
    {
        Ingredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('ingredient.index'));

        $ingredients = Ingredient::all();

        $response->assertExactJson($ingredients->toArray());
    }

    public function test_ingredients_can_be_fetched_when_some_ingredients_exist()
    {
        Ingredient::factory()->create();
        Ingredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('ingredient.index'));

        $ingredients = Ingredient::all();

        $response->assertExactJson($ingredients->toArray());
    }

    public function test_ingredients_can_be_fetched_when_no_ingredients_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('ingredient.index'));

        $ingredients = Ingredient::all();

        $response->assertExactJson($ingredients->toArray());
    }

    public function test_ingredient_can_be_created()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('ingredient.store'), [
            'name' => 'Reje',
            'is_in_stock' => true
        ]);

        $ingredients = Ingredient::all();

        $this->assertCount(1, $ingredients);
        $this->assertEquals('Reje', $ingredients->first()->name);
        $this->assertEquals(true, $ingredients->first()->is_in_stock);

        $result = $ingredients->first()->toArray();

        $result['is_in_stock'] = (bool)$result['is_in_stock'];

        $response->assertExactJson($result);
    }

    public function test_ingredient_can_not_be_created_when_name_exceeds_max_length()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('ingredient.store'), [
            'name' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
            'is_in_stock' => true,
        ]);

        $ingredients = Ingredient::all();

        $this->assertCount(0, $ingredients);

        $response->assertStatus(422);
    }

    public function test_ingredient_can_not_be_created_when_is_in_stock_is_invalid()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('ingredient.store'), [
            'name' => 'Reje',
            'is_in_stock' => 123,
        ]);

        $ingredients = Ingredient::all();

        $this->assertCount(0, $ingredients);

        $response->assertStatus(422);
    }

    public function test_ingredient_can_be_fetched()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('ingredient.show', ['ingredient' => Ingredient::factory()->create()]));

        $ingredients = Ingredient::all();

        $response->assertExactJson($ingredients->first()->toArray());
    }

    public function test_ingredient_can_be_updated()
    {
        $ingredient = Ingredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('ingredient.update', $ingredient), [
            'id' => $ingredient->id,
            'name' => 'Reje',
            'is_in_stock' => true
        ]);

        $ingredients = Ingredient::all();

        $this->assertCount(1, $ingredients);
        $this->assertEquals('Reje', $ingredients->first()->name);
        $this->assertEquals(true, $ingredients->first()->is_in_stock);

        $result = $ingredients->first()->toArray();

        $result['is_in_stock'] = (bool)$result['is_in_stock'];

        $response->assertExactJson($result);
    }

    public function test_ingredient_can_not_be_updated_when_name_exceeds_max_length()
    {
        $ingredient = Ingredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('ingredient.update', $ingredient), [
            'id' => $ingredient->id,
            'name' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
            'is_in_stock' => true
        ]);

        $ingredients = Ingredient::all();

        $this->assertCount(1, $ingredients);
        $this->assertEquals($ingredient->name, $ingredients->first()->name);
        $this->assertEquals($ingredient->is_in_stock, $ingredients->first()->is_in_stock);

        $response->assertStatus(422);
    }

    public function test_ingredient_can_not_be_updated_when_is_in_stock_is_invalid()
    {
        $ingredient = Ingredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('ingredient.update', $ingredient), [
            'id' => $ingredient->id,
            'name' => 'Reje',
            'is_in_stock' => 123
        ]);

        $ingredients = Ingredient::all();

        $this->assertCount(1, $ingredients);
        $this->assertEquals($ingredient->name, $ingredients->first()->name);
        $this->assertEquals($ingredient->is_in_stock, $ingredients->first()->is_in_stock);

        $response->assertStatus(422);
    }

    public function test_ingredient_can_be_deleted()
    {
        $ingredient = Ingredient::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('ingredient.destroy', $ingredient));

        $this->assertCount(0, Ingredient::all());

        $response->assertStatus(200);
    }
}
