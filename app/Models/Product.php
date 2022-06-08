<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'type', 'price', 'category_id', 'photo_path'];

    public function parent_category(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function ingredients(): BelongsToMany {
        return $this->belongsToMany(Ingredient::class, 'product_ingredients');
    }

    public function orders(): BelongsToMany {
        return $this->belongsToMany(Order::class, 'order_products')->withPivot(['id', 'price_at_purchase', 'status', 'created_at', 'updated_at']);
    }
}
