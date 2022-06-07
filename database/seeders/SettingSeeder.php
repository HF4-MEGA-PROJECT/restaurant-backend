<?php

namespace Database\Seeders;

use Faker\Provider\DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'key' => 'monday_opening',
            'value' => '12:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'monday_closing',
            'value' => '20:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'tuesday_opening',
            'value' => '12:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'tuesday_closing',
            'value' => '20:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'wednesday_opening',
            'value' => '12:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'wednesday_closing',
            'value' => '20:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'thursday_opening',
            'value' => '12:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'thursday_closing',
            'value' => '20:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'friday_opening',
            'value' => '12:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'friday_closing',
            'value' => '22:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'saturday_opening',
            'value' => '10:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'saturday_closing',
            'value' => '22:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'sunday_opening',
            'value' => '10:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'sunday_closing',
            'value' => '20:00:00',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'visit_length_minutes',
            'value' => 60,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('settings')->insert([
            'key' => 'max_visitors',
            'value' => 60,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);
    }
}
