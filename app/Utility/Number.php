<?php

namespace App\Utility;

class Number {
    public function lowestAvailableNumber(array $numbers): int {
        $lowestNumber = -1;
        foreach ($numbers as $i => $iValue) {
            if ($iValue !== $i) {
                $lowestNumber = $i;
                break;
            }
        }

        if ($lowestNumber === -1) {
            $highestNumber = $numbers[count($numbers) - 1] ?? 0;

            $lowestNumber = $highestNumber + 1;
        }

        return $lowestNumber;
    }
}
