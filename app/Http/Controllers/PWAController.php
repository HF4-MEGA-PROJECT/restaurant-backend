<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservation;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Utility\DateReservation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Date;

class PWAController extends Controller
{
    /**
     * Return menu
     *
     * @return JsonResponse
     */
    public function menu(): JsonResponse
    {
        $categories = Category::all(['id', 'name', 'category_id']);
        $products = Product::all('id', 'name', 'description', 'category_id', 'price', 'photo_path');
        $return = ['categories' => $categories, 'products' => $products];
        return response()->json($return);
    }

    /**
     * Return hours
     *
     * @return JsonResponse
     */
    public function hours(): JsonResponse
    {
        $return = ['hours_weekday' => '12 - 20', 'hours_weekend' => '10 - 22'];
        return response()->json($return);
    }

    /**
     * Store a reservation
     *
     * @param ReservationController $reservationController
     * @param StoreReservation $request
     * @return JsonResponse
     */
    public function reserve(ReservationController $reservationController, StoreReservation $request): JsonResponse
    {
        return $reservationController->store($request);
    }

    /**
     * @return JsonResponse
     */
    public function reserveDates(): JsonResponse
    {
        $settings = Setting::all()->pluck('value', 'key');
        $dateReservation = new DateReservation($settings->toArray());
        return response()->json(['unavailable_dates' => $dateReservation->getUnavailableDays()]);
    }

    /**
     * @param string $date
     * @return JsonResponse
     */
    public function reserveTimes(string $date): JsonResponse
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d H:i:s', $date . ' 12:00:00');
        $settings = Setting::all()->pluck('value', 'key');
        $dateReservation = new DateReservation($settings->toArray());
        return response()->json($dateReservation->getAvailableTimesForDay($carbonDate));
    }
}
