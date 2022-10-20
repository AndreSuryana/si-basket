<?php

namespace Database\Seeders;

use App\Models\LicenseLevel;
use Illuminate\Database\Seeder;

class LicenseLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            ['name' => 'C'],
            ['name' => 'B2'],
            ['name' => 'B1'],
            ['name' => 'A'],
            ['name' => 'FIBA'],
        ];

        LicenseLevel::insert($levels);
    }
}
