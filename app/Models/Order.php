<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['tables_id'];

    public function table(): BelongsTo {
        return $this->belongsTo(Table::class, 'tables_id', 'id');
    }
}
