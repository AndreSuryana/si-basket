<?php

namespace Database\Seeders;

use App\Models\RefereeLicense;
use Illuminate\Database\Seeder;

class RefereeLicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licenses = [
            [
                'referee_id' => 1,
                'game_type' => '3x3',
                'license_level' => 2,
                'document_path' => 'fakepath/document.pdf',
                'start_date' => '10/08/2022',
                'end_date' => '15/08/2022'
            ],
            [
                'referee_id' => 1,
                'game_type' => '5x5',
                'license_level' => 4,
                'document_path' => 'fakepath/document.pdf',
                'start_date' => '10/09/2022',
                'end_date' => '15/09/2022'
            ],
            [
                'referee_id' => 1,
                'game_type' => '3x3',
                'license_level' => 1,
                'document_path' => 'fakepath/document.pdf',
                'start_date' => '10/10/2022',
                'end_date' => '15/10/2022'
            ],
        ];

        RefereeLicense::create($licenses);
    }
}
