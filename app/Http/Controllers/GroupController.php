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
     * @param Group $group
     * @return JsonResponse
     */
    public function show(Group $group)
    {
        return response()->json($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGroup $request
     * @param Group $group
     * @return JsonResponse
     */
    public function update(UpdateGroup $request, Group $group)
    {
        $validated = $request->validated();

        $group->update([
            'amount_of_people' => $validated['amount_of_people'],
            'number' => $validated['number']
        ]);

        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return Response
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response('', 200);
    }
}
