<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductIngredient;
use App\Http\Requests\UpdateProductIngredient;
use App\Models\ProductIngredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(ProductIngredient::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductIngredient $request
     * @return JsonResponse
     */
    public function store(StoreProductIngredient $request): JsonResponse
    {
        $validated = $request->validated();

        $productIngredient = new ProductIngredient([
            'product_id' => $validated['product_id'],
            'ingredient_id' => $validated['ingredient_id']
        ]);

        $productIngredient->save();

        return response()->json($productIngredient, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ProductIngredient $productIngredient
     * @return JsonResponse
     */
    public function show(ProductIngredient $productIngredient): JsonResponse
    {
        return response()->json($productIngredient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductIngredient $request
     * @param ProductIngredient $productIngredient
     * @return JsonResponse
     */
    public function update(UpdateProductIngredient $request, ProductIngredient $productIngredient): JsonResponse
    {
        $validated = $request->validated();

        $productIngredient->update([
            'product_id' => $validated['product_id'],
            'ingredient_id' => $validated['ingredient_id']
        ]);

        return response()->json($productIngredient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductIngredient $productIngredient
     * @return Response
     */
    public function destroy(ProductIngredient $productIngredient): Response
    {
        $productIngredient->delete();

        return response('', 200);
    }
}
