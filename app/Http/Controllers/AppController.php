<?php

namespace App\Http\Controllers;

use App\Enums\OrderProductStatus;
use App\Models\Group;
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

    public function groupOrders(Group $group): JsonResponse {
        return response()->json(
            Order::query()
                ->where('group_id', '=', $group->id)
                ->with('products')
                ->get()
        );
    }
}
