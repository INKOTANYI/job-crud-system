<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $provinces = [
            'Kigali City',
            'Southern Province',
            'Northern Province',
            'Western Province',
            'Eastern Province',
        ];

        foreach ($provinces as $province) {
            Province::create(['name' => $province]);
        }
    }
}
