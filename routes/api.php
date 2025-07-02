<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Models\District;
use App\Models\Sector;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API endpoints for dynamic dropdowns
Route::get('/districts/{provinceId}', function ($provinceId) {
    $districts = District::where('province_id', $provinceId)->select('id', 'name', 'province_id')->get();
    return response()->json($districts);
});

Route::get('/sectors/{districtId}', function ($districtId) {
    $sectors = Sector::where('district_id', $districtId)->select('id', 'name', 'district_id')->get();
    return response()->json($sectors);
});

// API endpoint for jobs (distinct from web /jobs)
Route::get('/api/jobs', [JobController::class, 'index'])->name('api.jobs.index');