<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            ["name" => "Internasional"],
            ["name" => "Nasional"],
            ["name" => "Provinsi"],
            ["name" => "Kabupaten/Kota"],
        ];

        Level::insert($levels);
    }
}
