<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use App\Models\Province;

class DistrictSeeder extends Seeder
{
    public function run()
    {
        $provinces = Province::all();
        $districts = [
            ['name' => 'Gasabo', 'province_id' => $provinces[0]->id], // Kigali City
            ['name' => 'Huye', 'province_id' => $provinces[1]->id],  // Southern
            ['name' => 'Musanze', 'province_id' => $provinces[2]->id], // Northern
            ['name' => 'Rubavu', 'province_id' => $provinces[3]->id], // Western
            ['name' => 'Rwamagana', 'province_id' => $provinces[4]->id], // Eastern
            ['name' => 'Kicukiro', 'province_id' => $provinces[0]->id],
            ['name' => 'Nyaruguru', 'province_id' => $provinces[1]->id],
            ['name' => 'Burera', 'province_id' => $provinces[2]->id],
            ['name' => 'Karongi', 'province_id' => $provinces[3]->id],
            ['name' => 'Nyagatare', 'province_id' => $provinces[4]->id],
            ['name' => 'Nyarugenge', 'province_id' => $provinces[0]->id],
        ];

        foreach ($districts as $district) {
            District::create($district);
        }
    }
}
