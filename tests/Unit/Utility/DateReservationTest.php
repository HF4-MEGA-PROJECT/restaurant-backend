<?php

namespace Tests\Unit\Utility;

use App\Utility\DateReservation;
use Carbon\Carbon;
use Tests\TestCase;

class DateReservationTest extends TestCase
{
    private array $settings = [
        'monday_opening' => '12:00:00',
        'monday_closing' => '20:00:00',
        'tuesday_opening' => '12:00:00',
        'tuesday_closing' => '20:00:00',
        'wednesday_opening' => '12:00:00',
        'wednesday_closing' => '20:00:00',
        'thursday_opening' => '12:00:00',
        'thursday_closing' => '20:00:00',
        'friday_opening' => '12:00:00',
        'friday_closing' => '22:00:00',
        'saturday_opening' => '10:00:00',
        'saturday_closing' => '22:00:00',
        'sunday_opening' => '10:00:00',
        'sunday_closing' => '20:00:00',
        'visit_length_minutes' => '60',
        'max_visitors' => '60',
    ];

    public function test_getTimesForDayOfWeek(): void {
        $dateReservation = new DateReservation($this->settings);
        $date = Carbon::now();
        $dateReservation->getAvailableTimesForDay($date);
    }
}