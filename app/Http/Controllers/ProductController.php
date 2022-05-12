<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProduct $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProduct $request)
    {
        $validated = $request->validated();

        $product = new Product([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'categories_id' => $validated['categories_id']
        ]);

        $product->save();

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProduct $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProduct $request, Product $product)
    {
        $validated = $request->validated();

        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'categories_id' => $validated['categories_id']
        ]);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response('', 200);
    }
}
