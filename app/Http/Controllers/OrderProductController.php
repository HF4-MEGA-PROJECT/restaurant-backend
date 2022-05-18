<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderProduct;
use App\Http\Requests\UpdateOrderProduct;
use App\Models\OrderProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(OrderProduct::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderProduct $request
     * @return JsonResponse
     */
    public function store(StoreOrderProduct $request)
    {
        $validated = $request->validated();

        $orderProduct = new OrderProduct([
            'price_at_purchase' => $validated['price_at_purchase'],
            'product_id' => $validated['product_id'],
            'order_id' => $validated['order_id']
        ]);

        $orderProduct->save();

        return response()->json($orderProduct, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param OrderProduct $orderProduct
     * @return JsonResponse
     */
    public function show(OrderProduct $orderProduct)
    {
        return response()->json($orderProduct);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderProduct $request
     * @param OrderProduct $orderProduct
     * @return JsonResponse
     */
    public function update(UpdateOrderProduct $request, OrderProduct $orderProduct)
    {
        $validated = $request->validated();

        $orderProduct->update([
            'price_at_purchase' => $validated['price_at_purchase'],
            'product_id' => $validated['product_id'],
            'order_id' => $validated['order_id']
        ]);

        return response()->json($orderProduct);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OrderProduct $orderProduct
     * @return Response
     */
    public function destroy(OrderProduct $orderProduct)
    {
        $orderProduct->delete();

        return response('', 200);
    }
}
