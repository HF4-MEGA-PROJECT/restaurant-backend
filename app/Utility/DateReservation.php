<?php

namespace App\Utility;

use App\Models\Setting;
use Carbon\Carbon;

class DateReservation {
    private array $settings;

    private array $timesInDay = [];

    public function __construct()
    {
        $this->settings = ['wednesday_opening' => '10:00:00', 'wednesday_closing' => '10:00:00', 'visit_length_minutes' => 60];
    }

    public function getUnavailableDays(): array {
        return [];
    }

    public function getAvailableTimesForDay(Carbon $day): array {
        return [];
    }

    public function checkIfTimeIsAvailableForDay(Carbon $datetime): array {
        return [];
    }

    public function getTimesForDayOfWeek(Carbon $carbon): array {
        $dayOfWeek = strtolower($carbon->englishDayOfWeek);

        $openingTime = $this->settings[$dayOfWeek.'_opening'];
        $closingTime = $this->settings[$dayOfWeek.'_closing'];
        $visitLengthMinutes = $this->settings['visit_length_minutes'];

        error_log(print_r($openingTime, true));
        error_log(print_r($closingTime, true));

        return [];
    }
}
