<?php

namespace App\Utility;

use App\Models\Setting;
use Carbon\Carbon;

class DateReservation {
    private array $settings;

    private array $timesInDay = [];

    public function __construct()
    {
        $this->settings = ['wednesday_opening' => '10:00:00', 'wednesday_closing' => '22:00:00', 'visit_length_minutes' => 60];
    }

    public function getUnavailableDays(): array {
        return [];
    }

    public function getAvailableTimesForDay(Carbon $day): array {
        return $this->getTimesForDayOfWeek($day);
    }

    public function checkIfTimeIsAvailableForDay(Carbon $datetime): array {
        return [];
    }

    public function getTimesForDayOfWeek(Carbon $carbon): array {
        $dayOfWeek = strtolower($carbon->englishDayOfWeek);

        $openingTime = $this->settings[$dayOfWeek.'_opening'];
        $closingTime = $this->settings[$dayOfWeek.'_closing'];
        $visitLengthMinutes = $this->settings['visit_length_minutes'];

        $times = [];
        for ($carbon->setTimeFromTimeString($openingTime) ; $carbon->format('H:i:s') !== $closingTime ; ) {
            $startTime = $carbon->format('H:i:s');
            $carbon->addMinutes($visitLengthMinutes);
            $endTime = $carbon->format('H:i:s');
            $times[] = [
                'startTime' => $startTime,
                'endTime' => $endTime,
                ];
        }

        return $times;
    }
}
