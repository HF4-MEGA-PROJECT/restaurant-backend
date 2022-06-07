<?php

namespace App\Models;

use App\Enums\ProductTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['group_id'];

    public function group(): BelongsTo {
        return $this->belongsTo(Group::class);
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot(['id', 'price_at_purchase', 'status', 'created_at', 'updated_at']);
    }

    public function kitchenProducts(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot(['id', 'price_at_purchase', 'status', 'created_at', 'updated_at'])->where('type', '=', ProductTypes::FOOD->value);
    }

    public function barProducts(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot(['id', 'price_at_purchase', 'status', 'created_at', 'updated_at'])->whereIn('type', [ProductTypes::DRINKS->value, ProductTypes::SNACKS->value]);
    }
}
