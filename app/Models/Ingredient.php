<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_in_stock'];

    public function products(): HasManyThrough {
        return $this->hasManyThrough(Product::class, ProductIngredient::class, 'ingredient_id', 'id', null, 'product_id');
    }
}
