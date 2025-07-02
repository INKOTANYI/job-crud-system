<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sector;
use App\Models\District;

class SectorSeeder extends Seeder
{
    public function run()
    {
        $districts = District::all();
        $sectors = [
            ['name' => 'Kacyiru', 'district_id' => $districts[0]->id], // Gasabo
            ['name' => 'Tumba', 'district_id' => $districts[1]->id],  // Huye
            ['name' => 'Muhoza', 'district_id' => $districts[2]->id], // Musanze
            ['name' => 'Gisenyi', 'district_id' => $districts[3]->id], // Rubavu
            ['name' => 'Muhima', 'district_id' => $districts[4]->id], // Rwamagana
            ['name' => 'Gahanga', 'district_id' => $districts[5]->id], // Kicukiro
            ['name' => 'Kirehe', 'district_id' => $districts[6]->id], // Nyaruguru
            ['name' => 'Busasamana', 'district_id' => $districts[7]->id], // Burera
            ['name' => 'Kivumu', 'district_id' => $districts[8]->id], // Karongi
            ['name' => 'Gahini', 'district_id' => $districts[9]->id], // Nyagatare
            ['name' => 'Nyamirambo', 'district_id' => $districts[10]->id], // Nyarugenge
            ['name' => 'Remera', 'district_id' => $districts[0]->id],
            ['name' => 'Ngoma', 'district_id' => $districts[1]->id],
            ['name' => 'Cyinzuzi', 'district_id' => $districts[2]->id],
            ['name' => 'Kanombe', 'district_id' => $districts[3]->id],
            ['name' => 'Fumbwe', 'district_id' => $districts[4]->id],
            ['name' => 'Gatenga', 'district_id' => $districts[5]->id],
            ['name' => 'Matare', 'district_id' => $districts[6]->id],
            ['name' => 'Kagano', 'district_id' => $districts[7]->id],
            ['name' => 'Bwishyura', 'district_id' => $districts[8]->id],
            ['name' => 'Karaba', 'district_id' => $districts[9]->id],
            ['name' => 'Kimironko', 'district_id' => $districts[0]->id],
            ['name' => 'Rukomo', 'district_id' => $districts[9]->id],
        ];

        foreach ($sectors as $sector) {
            Sector::create($sector);
        }
    }
}
