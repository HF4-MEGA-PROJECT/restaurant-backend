<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTable;
use App\Http\Requests\UpdateTable;
use App\Models\Table;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Table::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTable $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTable $request)
    {
        $validated = $request->validated();

        $setting = new Table([
            'amount_of_people' => $validated['amount_of_people'],
            'number' => $validated['number']
        ]);

        $setting->save();

        return response()->json($setting, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Table $table)
    {
        return response()->json($table);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTable $request
     * @param \App\Models\Table $table
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTable $request, Table $table)
    {
        $validated = $request->validated();

        $table->update([
            'amount_of_people' => $validated['amount_of_people'],
            'number' => $validated['number']
        ]);

        return response()->json($table);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();

        return response('', 200);
    }
}
