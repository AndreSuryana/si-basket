<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ["province_id" => 1, "name" => "Denpasar"],
            ["province_id" => 1, "name" => "Badung"],
            ["province_id" => 1, "name" => "Gianyar"],
            ["province_id" => 1, "name" => "Tabanan"],
            ["province_id" => 1, "name" => "Jembrana"],
            ["province_id" => 1, "name" => "Buleleng"],
            ["province_id" => 1, "name" => "Karangasem"],
            ["province_id" => 1, "name" => "Klungkung"],
            ["province_id" => 1, "name" => "Bangli"],
        ];

        City::insert($cities);
    }
}
