<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservation;
use App\Http\Requests\UpdateReservation;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Reservation::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Reservation $reservation)
    {
        return response()->json($reservation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReservation $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreReservation $request)
    {
        $validated = $request->validated();

        $reservation = new Reservation([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'time' => $validated['time'],
            'amount_of_people' => $validated['amount_of_people']
        ]);

        $reservation->save();

        return response()->json($reservation, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateReservation $request, Reservation $reservation)
    {
        $validated = $request->validated();

        $reservation->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'time' => $validated['time'],
            'amount_of_people' => $validated['amount_of_people']
        ]);

        return response()->json($reservation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response('', 200);
    }
}
