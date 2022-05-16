<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservation;
use App\Http\Requests\UpdateReservation;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Reservation::all());
    }

    /**
     * Display the specified resource.
     *
     * @param Reservation $reservation
     * @return JsonResponse
     */
    public function show(Reservation $reservation)
    {
        return response()->json($reservation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReservation $request
     * @return JsonResponse
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
     * @param UpdateReservation $request
     * @param Reservation $reservation
     * @return JsonResponse
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
     * @param Reservation $reservation
     * @return Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response('', 200);
    }
}
