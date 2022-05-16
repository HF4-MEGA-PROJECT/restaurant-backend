<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderProduct;
use App\Http\Requests\UpdateOrderProduct;
use App\Models\OrderProduct;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(OrderProduct::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderProduct $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOrderProduct $request)
    {
        $validated = $request->validated();

        $order = new OrderProduct([
            'price' => $validated['price'],
            'products_id' => $validated['products_id'],
            'orders_id' => $validated['orders_id']
        ]);

        $order->save();

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(OrderProduct $orderProduct)
    {
        return response()->json($orderProduct);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateOrderProduct $request, OrderProduct $orderProduct)
    {
        $validated = $request->validated();

        $orderProduct->update([
            'price' => $validated['price'],
            'products_id' => $validated['products_id'],
            'orders_id' => $validated['orders_id']
        ]);

        return response()->json($orderProduct);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderProduct $orderProduct)
    {
        $orderProduct->delete();

        return response('', 200);
    }
}
