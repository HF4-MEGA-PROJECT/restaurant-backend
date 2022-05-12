<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSetting;
use App\Http\Requests\UpdateSetting;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Setting::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSetting $request)
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Setting $setting)
    {
        return response()->json($setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSetting $request, Setting $setting)
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return response('', 200);
    }
}
