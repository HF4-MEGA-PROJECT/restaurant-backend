<?php

namespace App\Utility;

use Carbon\Carbon;

class DateReservation {
    private array $timesInDay = [];

    public function getUnavailableDays(): array {
        return [];
    }

    public function getAvailableTimesForDay(Carbon $day): array {
        return [];
    }

    public function checkIfTimeIsAvailableForDay(Carbon $datetime): array {
        return [];
    }

    public function getTimesForDayOfWeek(Carbon $dayOfWeek): array {
        return [];
    }
}
