<?php

namespace App\Utility;

class Number {
    public function lowestAvailableNumber(array $numbers, int $minimum): int {
        sort($numbers, SORT_ASC);

        $lowestNumber = -1;
        foreach ($numbers as $number) {
            if ($number !== $minimum) {
                $lowestNumber = $minimum;
                break;
            }
            ++$minimum;
        }

        if ($lowestNumber === -1) {
            $highestNumber = $numbers[count($numbers) - 1] ?? 0;

            $lowestNumber = $highestNumber + 1;
        }

        return $lowestNumber;
    }
}
