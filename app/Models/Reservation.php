<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'time', 'amount_of_people'];

    public static function reservationsToday(): int {
        return self::query()->whereDate('time', '=', Carbon::today())->count();
    }
}
