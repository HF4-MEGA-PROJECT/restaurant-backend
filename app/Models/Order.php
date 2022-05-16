<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['tables_id'];

    public function table(): BelongsTo {
        return $this->belongsTo(Table::class, 'tables_id', 'id');
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'order_products', 'orders_id', 'products_id')->withPivot('price');
    }
}
