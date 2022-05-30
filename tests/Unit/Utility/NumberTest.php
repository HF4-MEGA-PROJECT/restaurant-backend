<?php

namespace Tests\Unit\Utility;

use App\Utility\Number;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    public function test_lowestAvailableNumber_middle_number_missing(): void {
        $number = new Number();

        $array = [0, 2, 3, 4, 5, 8];

        $this->assertEquals(1, $number->lowestAvailableNumber($array));
    }

    public function test_lowestAvailableNumber_no_number_missing(): void {
        $number = new Number();

        $array = [0, 1, 2, 3, 4, 5];

        $this->assertEquals(6, $number->lowestAvailableNumber($array));
    }

    public function test_lowestAvailableNumber_array_empty(): void {
        $number = new Number();

        $array = [];

        $this->assertEquals(1, $number->lowestAvailableNumber($array));
    }
}
