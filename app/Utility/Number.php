<?php

namespace App\Utility;

class Number {
    public function lowestAvailableNumber(array $numbers): int {
        sort($numbers, SORT_ASC);

        $lowestNumber = -1;
        $offset = $numbers[0] ?? 0;
        foreach ($numbers as $number) {
            if ($number !== $offset) {
                $lowestNumber = $offset;
                break;
            }
            ++$offset;
        }

        if ($lowestNumber === -1) {
            $highestNumber = $numbers[count($numbers) - 1] ?? 0;

            $lowestNumber = $highestNumber + 1;
        }

        return $lowestNumber;
    }
}
