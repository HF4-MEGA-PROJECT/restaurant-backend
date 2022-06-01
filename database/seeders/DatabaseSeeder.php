<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(CategorySeeder $categorySeeder, ProductSeeder $productSeeder, ReservationSeeder $reservationSeeder, GroupSeeder $groupSeeder, IngredientSeeder $ingredientSeeder, SettingSeeder $settingSeeder)
    {
        $categorySeeder->run();
        $productSeeder->run();
        $reservationSeeder->run();
        $groupSeeder->run();
        $ingredientSeeder->run();
        $settingSeeder->run();
    }
}
