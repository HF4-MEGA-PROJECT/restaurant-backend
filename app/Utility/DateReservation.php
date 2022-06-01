<?php

namespace App\Utility;

use App\Models\Reservation;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DateReservation
{
    private array $settings;

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function getUnavailableDays(): array
    {
        $return = DB::table('reservations')
            ->selectRaw("DATE_FORMAT(time, '%Y-%m-%d')  as 'day'")
            ->groupByRaw("DATE_FORMAT(time, '%Y-%m-%d')")
            ->havingRaw('SUM(amount_of_people) > ?', [3])
            ->get()
            ->map(function ($item, $key) {
                return $item['day'];
            })
            ->toArray();

        return [];
    }

    public function getAvailableTimesForDay(Carbon $day): array
    {
        $timesForToday = $this->getTimesForDayOfWeek($day);
        $max = (($this->settings['max_visitors'] / 3) * 2);

        $timesForTodayWithAvailability = [];
        foreach ($timesForToday as $time) {
            $from = Carbon::createFromFormat('Y-m-d H:i:s', $day->format('Y-m-d') . ' ' . $time['startTime'])->toDateTimeString();
            $to = Carbon::createFromFormat('Y-m-d H:i:s', $day->format('Y-m-d') . ' ' . $time['endTime'])->toDateTimeString();
            $sum = (int)Reservation::whereBetween('time', [$from, $to])->sum('amount_of_people');

            if ($sum > $max) {
                $time['available'] = false;
            } else {
                $time['available'] = true;
            }

            $timesForTodayWithAvailability[] = $time;
        }

        return $timesForTodayWithAvailability;
    }

    public function IsTimeAvailableForDay(Carbon $datetime): bool
    {
        $timesForTodayWithAvailability = $this->getAvailableTimesForDay($datetime);
        $timeFormatted = $datetime->format('H:i:s');

        foreach ($timesForTodayWithAvailability as $time) {
            if ($timeFormatted === $time['startTime']) {
                return $time['available'];
            }
        }

        return true;
    }

    public function getTimesForDayOfWeek(Carbon $carbon): array
    {
        $dayOfWeek = strtolower($carbon->englishDayOfWeek);

        $openingTime = $this->settings[$dayOfWeek . '_opening'];
        $closingTime = $this->settings[$dayOfWeek . '_closing'];
        $visitLengthMinutes = $this->settings['visit_length_minutes'];

        $times = [];
        for ($carbon->setTimeFromTimeString($openingTime); $carbon->format('H:i:s') !== $closingTime;) {
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
