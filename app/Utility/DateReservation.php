<?php

namespace App\Utility;

use App\Models\Setting;
use Carbon\Carbon;

class DateReservation {
    private array $settings;

    private array $timesInDay = [];

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function getUnavailableDays(): array {
        return [];
    }

    public function getAvailableTimesForDay(Carbon $day): array {
        return $this->getTimesForDayOfWeek($day);
    }

    public function IsTimeAvailableForDay(Carbon $datetime): bool {
        return true;
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
                'available' => true,
                ];
        }

        return $times;
    }
}
