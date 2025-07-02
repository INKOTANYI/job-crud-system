<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index($districtId)
    {
        return Sector::where('district_id', $districtId)->get();
    }

    public function show($sectorId)
    {
        return Sector::where('id', $sectorId)->get();
    }
}
