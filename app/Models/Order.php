<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['group_id'];

    public function group(): BelongsTo {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')->withPivot('price');
    }
}
