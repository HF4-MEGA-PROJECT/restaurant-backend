<?php

namespace Tests\Unit\Utility;

use App\Utility\DateReservation;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class DateReservationTest extends TestCase
{
    public function test_getTimesForDayOfWeek(): void {
        $dateReservation = new DateReservation();
        $date = Carbon::now();
        $dateReservation->getTimesForDayOfWeek($date);
    }
}
