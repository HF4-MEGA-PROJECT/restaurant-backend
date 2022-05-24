<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSetting;
use App\Http\Requests\UpdateSetting;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Setting::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSetting $request
     * @return JsonResponse
     */
    public function store(StoreSetting $request): JsonResponse
    {
        $validated = $request->validated();

        $setting = new Setting([
            'key' => $validated['key'],
            'value' => $validated['value']
        ]);

        $setting->save();

        return response()->json($setting, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Setting $setting
     * @return JsonResponse
     */
    public function show(Setting $setting): JsonResponse
    {
        return response()->json($setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSetting $request
     * @param Setting $setting
     * @return JsonResponse
     */
    public function update(UpdateSetting $request, Setting $setting): JsonResponse
    {
        $validated = $request->validated();

        $setting->update([
            'key' => $validated['key'],
            'value' => $validated['value']
        ]);

        return response()->json($setting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Setting $setting
     * @return Response
     */
    public function destroy(Setting $setting): Response
    {
        $setting->delete();

        return response('', 200);
    }
}
