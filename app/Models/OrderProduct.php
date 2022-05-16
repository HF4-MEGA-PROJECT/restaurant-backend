<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'products_id', 'orders_id'];

    public function product(): HasOne {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class, 'orders_id', 'id');
    }
}
