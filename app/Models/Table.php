<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Table extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['amount_of_people', 'number'];

    public function orders(): HasMany {
        return $this->hasMany(Order::class, 'orders_id', 'id');
    }

    public static function totalGuests(): int {
        $tables = self::query()->where('deleted_at', '=', null)->get();

        $total_guests = 0;

        foreach ($tables as $table) {
            $total_guests += $table->amount_of_people;
        }

        return $total_guests;
    }

    public static function currentTables(): array {
        return DB::table('tables', 't')
                    ->select(['t.id', 't.amount_of_people', 't.number', 't.created_at', 't.deleted_at', DB::RAW('SUM(order_products.price) AS order_total')])
                    ->leftJoin('orders', 't.id', '=', 'orders.tables_id')
                    ->leftJoin('order_products', 'order_products.orders_id', '=', 'orders.id')
                    ->where('t.deleted_at', '=', null)
                    ->groupBy(['t.id', 't.amount_of_people', 't.number', 't.created_at', 't.deleted_at'])
                    ->get()
                    ->toArray();
    }
}
