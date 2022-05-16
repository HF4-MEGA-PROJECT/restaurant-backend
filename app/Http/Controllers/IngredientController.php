<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredient;
use App\Http\Requests\UpdateIngredient;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Ingredient::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreIngredient $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreIngredient $request)
    {
        $validated = $request->validated();

        $order = new Ingredient([
            'name' => $validated['name'],
            'is_in_stock' => $validated['is_in_stock']
        ]);

        $order->save();

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Ingredient $ingredient)
    {
        return response()->json($ingredient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateIngredient $request
     * @param \App\Models\Ingredient $ingredient
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateIngredient $request, Ingredient $ingredient)
    {
        $validated = $request->validated();

        $ingredient->update([
            'name' => $validated['name'],
            'is_in_stock' => $validated['is_in_stock']
        ]);

        return response()->json($ingredient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return response('', 200);
    }
}
