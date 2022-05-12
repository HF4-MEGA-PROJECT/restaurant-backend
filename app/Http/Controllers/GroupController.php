<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroup;
use App\Http\Requests\UpdateGroup;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Group::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGroup $request
     * @return JsonResponse
     */
    public function store(StoreGroup $request)
    {
        $validated = $request->validated();

        $group = new Group([
            'amount_of_people' => $validated['amount_of_people'],
            'number' => $validated['number']
        ]);

        $group->save();

        return response()->json($group, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Group $table
     * @return JsonResponse
     */
    public function show(Group $table)
    {
        return response()->json($table);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGroup $request
     * @param Group $table
     * @return JsonResponse
     */
    public function update(UpdateGroup $request, Group $table)
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
     * @param Group $table
     * @return Response
     */
    public function destroy(Group $table)
    {
        $table->delete();

        return response('', 200);
    }
}
