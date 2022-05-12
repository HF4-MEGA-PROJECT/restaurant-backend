<?php

namespace Tests\Feature\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_parent_category()
    {
        $category = new Category(['name' => 'Hovedretter', 'categories_id' => null]);
        $category->save();

        $product = new Product(['name' => 'Tigerrejesalat', 'price' => 123, 'categories_id' => $category->id]);
        $product->save();

        $this->assertEquals($category->toArray(), $product->parent_category()->first()->toArray());
    }
}
