<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroup;
use App\Http\Requests\UpdateGroup;
use App\Models\Group;
use App\Utility\Number;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Group::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGroup $request
     * @return JsonResponse
     */
    public function store(StoreGroup $request): JsonResponse
    {
        $validated = $request->validated();

        $group = new Group([
            'amount_of_people' => $validated['amount_of_people'],
            'number' => (new Number())->lowestAvailableNumber(Group::all(['number'])->map(static function (Group $group) {
                return $group->number;
            })->toArray())
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
    public function show(Group $group): JsonResponse
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
    public function update(UpdateGroup $request, Group $group): JsonResponse
    {
        $validated = $request->validated();

        $group->update([
            'amount_of_people' => $validated['amount_of_people']
        ]);

        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return Response
     */
    public function destroy(Group $group): Response
    {
        $group->delete();

        return response('', 200);
    }
}
