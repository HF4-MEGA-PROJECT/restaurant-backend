<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductIngredient extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'ingredient_id'];

    public function ingredient(): HasOne {
        return $this->hasOne(Ingredient::class, 'id', 'ingredient_id');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
