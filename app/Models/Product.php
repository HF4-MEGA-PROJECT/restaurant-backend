<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price', 'categories_id'];

    public function parent_category(): BelongsTo {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function ingredients(): HasManyThrough {
        return $this->hasManyThrough(Ingredient::class, ProductIngredient::class, 'products_id', 'id', null, 'ingredients_id');
    }
}
