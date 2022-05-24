<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategory $request
     * @return JsonResponse
     */
    public function store(StoreCategory $request): JsonResponse
    {
        $validated = $request->validated();

        $category = new Category([
            'name' => $validated['name'],
            'category_id' => $validated['category_id']
        ]);

        $category->save();

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategory $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategory $request, Category $category): JsonResponse
    {
        $validated = $request->validated();

        $category->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id']
        ]);

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category): Response
    {
        $category->delete();

        return response('', 200);
    }
}
