<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_can_be_fetched_when_one_category_exist()
    {
        Category::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('category.index'));

        $categories = Category::all();

        $response->assertExactJson($categories->toArray());
    }

    public function test_categories_can_be_fetched_when_some_categories_exist()
    {
        Category::factory()->create();
        Category::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('category.index'));

        $categories = Category::all();

        $response->assertExactJson($categories->toArray());
    }

    public function test_categories_can_be_fetched_when_no_categories_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('category.index'));

        $categories = Category::all();

        $response->assertExactJson($categories->toArray());
    }

    public function test_category_can_be_created()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('category.store'), [
            'name' => 'Hovedret',
            'categories_id' => null
        ]);

        $categories = Category::all();

        $this->assertCount(1, $categories);
        $this->assertEquals('Hovedret', $categories->first()->name);
        $this->assertEquals(null, $categories->first()->categories_id);

        $response->assertExactJson($categories->first()->toArray());
    }

    public function test_category_can_not_be_created_when_name_exceeds_max_length()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('category.store'), [
            'name' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
            'categories_id' => null
        ]);

        $categories = Category::all();

        $this->assertCount(0, $categories);

        $response->assertStatus(422);
    }

    public function test_category_can_not_be_created_when_parent_category_does_not_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('category.store'), [
            'name' => 'Hovedret',
            'categories_id' => 1
        ]);

        $categories = Category::all();

        $this->assertCount(0, $categories);

        $response->assertStatus(422);
    }

    public function test_category_can_be_fetched()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('category.show', ['category' => Category::factory()->create()]));

        $categories = Category::all();

        $response->assertExactJson($categories->first()->toArray());
    }

    public function test_category_can_be_updated()
    {
        $category = Category::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('category.update', $category), [
            'id' => $category->id,
            'name' => 'Hovedret',
            'categories_id' => null
        ]);

        $categories = Category::all();

        $this->assertCount(1, $categories);
        $this->assertEquals('Hovedret', $categories->first()->name);
        $this->assertEquals(null, $categories->first()->categories_id);

        $response->assertExactJson($categories->first()->toArray());
    }

    public function test_category_can_not_be_updated_when_name_exceeds_max_length()
    {
        $category = Category::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('category.update', $category), [
            'id' => $category->id,
            'name' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
            'categories_id' => null
        ]);

        $categories = Category::all();

        $this->assertCount(1, $categories);
        $this->assertEquals($category->name, $categories->first()->name);
        $this->assertEquals($category->categories_id, $categories->first()->categories_id);

        $response->assertStatus(422);
    }

    public function test_category_can_not_be_updated_when_parent_category_does_not_exist()
    {
        $category = Category::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('category.update', $category), [
            'id' => $category->id,
            'name' => 'Hovedret',
            'categories_id' => 123
        ]);

        $categories = Category::all();

        $this->assertCount(1, $categories);
        $this->assertEquals($category->name, $categories->first()->name);
        $this->assertEquals($category->categories_id, $categories->first()->categories_id);

        $response->assertStatus(422);
    }

    public function test_category_can_be_deleted()
    {
        $category = Category::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('category.destroy', $category));

        $this->assertCount(0, Category::all());

        $response->assertStatus(200);
    }
}
