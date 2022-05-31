<?php

namespace App\Http\Controllers;

use App\Enums\OrderProductStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class AppController extends Controller
{
    public function orders(): JsonResponse {
        return response()->json(
            Order::query()->whereHas('products', static function (Builder $q) {
                $q->where('status', '!=', OrderProductStatus::DELIVERABLE);
            })->with('products')->get());
    }
}
