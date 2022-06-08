<?php

namespace Database\Factories;

use App\Models\Group;
use App\Utility\Number;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount_of_people' => $this->faker->numberBetween(1, 16),
            'number' => (new Number())->lowestAvailableNumber(Group::all(['number'])->map(static function (Group $group) {
                return $group->number;
            })->toArray(), 1)
        ];
    }
}
