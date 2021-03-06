<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrder;
use App\Http\Requests\UpdateOrder;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Order::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrder $request
     * @return JsonResponse
     */
    public function store(StoreOrder $request): JsonResponse
    {
        $validated = $request->validated();

        $order = new Order([
            'group_id' => $validated['group_id']
        ]);

        $order->save();

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function show(Order $order): JsonResponse
    {
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrder $request
     * @param Order $order
     * @return JsonResponse
     */
    public function update(UpdateOrder $request, Order $order): JsonResponse
    {
        $validated = $request->validated();

        $order->update([
            'group_id' => $validated['group_id']
        ]);

        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return Response
     */
    public function destroy(Order $order): Response
    {
        $order->delete();

        return response('', 200);
    }
}
