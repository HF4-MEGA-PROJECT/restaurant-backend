<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductIngredient extends Model
{
    use HasFactory;

    protected $fillable = ['products_id', 'ingredients_id'];

    public function ingredient(): HasOne {
        return $this->hasOne(Ingredient::class, 'id', 'ingredients_id');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
