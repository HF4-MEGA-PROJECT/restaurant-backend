<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_sub_categories()
    {
        $main_dishes = new Category(['name' => 'Hovedretter', 'category_id' => null]);
        $main_dishes->save();

        $salads = new Category(['name' => 'Salater', 'category_id' => $main_dishes->id]);
        $salads->save();

        $this->assertEquals([$salads->toArray()], $main_dishes->sub_categories()->get()->toArray());
    }

    public function test_can_get_parent_category()
    {
        $main_dishes = new Category(['name' => 'Hovedretter', 'category_id' => null]);
        $main_dishes->save();

        $salads = new Category(['name' => 'Salater', 'category_id' => $main_dishes->id]);
        $salads->save();

        $this->assertEquals($main_dishes->toArray(), $salads->parent_category()->first()->toArray());
    }
}
