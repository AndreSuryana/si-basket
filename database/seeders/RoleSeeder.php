<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ["name" => "Registered User"],
            ["name" => "Wasit/Pelatih"],
            ["name" => "Admin Kabupaten/Kota"],
            ["name" => "Admin Provinsi"],
        ];

        Role::insert($roles);
    }
}
