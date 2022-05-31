<?php

namespace Tests\Feature\CategoryChild;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_can_be_fetched_when_one_category_exist()
    {
        $category = Category::factory()->create();
        Category::factory()->create(['category_id' => $category->id]);

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('category.children.index', $category));

        $categories = $category->sub_categories()->get();

        error_log(print_r($categories->toArray(), true));

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
}
