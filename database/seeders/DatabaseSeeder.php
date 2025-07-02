<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,          // Add UserSeeder first
            ProvinceSeeder::class,
            DistrictSeeder::class,
            SectorSeeder::class,
            DepartmentSeeder::class,
            CategorySeeder::class,
            CompanySeeder::class,
        ]);
    }
}
