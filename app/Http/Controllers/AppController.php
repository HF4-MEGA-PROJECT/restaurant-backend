<?php

namespace App\Http\Controllers;

use App\Enums\OrderProductStatus;
use App\Enums\ProductTypes;
use App\Models\Group;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class AppController extends Controller
{
    public function kitchenOrders(): JsonResponse {
        return response()->json(
            Order::query()->whereHas('kitchenProducts', static function (Builder $q) {
                $q->where('status', '!=', OrderProductStatus::DELIVERABLE);
            })->with(['products' => static function ($query) {
                $query->where('type', '=', ProductTypes::FOOD->value);
        }])->get());
    }

    public function barOrders(): JsonResponse {
        return response()->json(
            Order::query()->whereHas('barProducts', static function (Builder $q) {
                $q->where('status', '!=', OrderProductStatus::DELIVERABLE);
            })->with(['products' => static function ($query) {
                $query->whereIn('type', [ProductTypes::DRINKS->value, ProductTypes::SNACKS->value]);
            }])->get());
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
