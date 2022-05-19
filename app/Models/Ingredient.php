<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_in_stock'];

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'product_ingredients');
    }
}
