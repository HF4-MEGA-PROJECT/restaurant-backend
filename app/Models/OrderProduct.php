<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'product_id', 'order_id'];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
    }

    public static function revenueThisMonth(): float {
        $orderProducts = self::productsSoldThisMonth();

        $revenue = 0;

        foreach ($orderProducts as $orderProduct) {
            $revenue += $orderProduct->price;
        }

        return $revenue;
    }

    /**
     * @return OrderProduct[]|Collection
     */
    public static function productsSoldThisMonth(): Collection|array {
        return self::query()->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
    }
}
