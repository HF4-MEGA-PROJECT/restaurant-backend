<?php

namespace Database\Seeders;

use Faker\Provider\DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Forretter',
            'category_id' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Hovedretter',
            'category_id' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Fisk',
            'category_id' => 2,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Kød',
            'category_id' => 2,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Salat',
            'category_id' => 2,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Desserter',
            'category_id' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Drinks',
            'category_id' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);
    }
}
