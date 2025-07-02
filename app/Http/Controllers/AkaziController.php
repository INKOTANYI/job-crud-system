<?php

namespace App\Http\Controllers;

use App\Models\Akazi;
use Illuminate\Http\Request;

class AkaziController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akazis = Akazi::with(['company', 'department', 'province', 'district', 'sector'])->get();
        return view('akazi.index', compact('akazis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = \App\Models\Company::all();
        $departments = \App\Models\Department::all();
        $provinces = \App\Models\Province::with('districts')->get(); // Eager-load districts for dynamic dropdowns
        $districts = \App\Models\District::all(); // Keep for reference, but primary use is via provinces->districts
        $sectors = \App\Models\Sector::all();     // Keep for reference, to be used for sector dropdown
        return view('akazi.create', compact('companies', 'departments', 'provinces', 'districts', 'sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'qualification' => 'required',
            'company_id' => 'required|exists:companies,id',
            'department_id' => 'required|exists:departments,id',
            'deadline' => 'required|date',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'sector_id' => 'required|exists:sectors,id',
        ]);

        Akazi::create($validated);
        return redirect()->route('akazi.index')->with('success', 'Akazi created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Akazi $akazi)
    {
        return view('akazi.show', compact('akazi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akazi $akazi)
    {
        $companies = \App\Models\Company::all();
        $departments = \App\Models\Department::all();
        $provinces = \App\Models\Province::with('districts')->get(); // Eager-load districts for consistency with create
        $districts = \App\Models\District::all();
        $sectors = \App\Models\Sector::all();
        return view('akazi.edit', compact('akazi', 'companies', 'departments', 'provinces', 'districts', 'sectors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akazi $akazi)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'qualification' => 'required',
            'company_id' => 'required|exists:companies,id',
            'department_id' => 'required|exists:departments,id',
            'deadline' => 'required|date',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'sector_id' => 'required|exists:sectors,id',
        ]);

        $akazi->update($validated);
        return redirect()->route('akazi.index')->with('success', 'Akazi updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akazi $akazi)
    {
        $akazi->delete();
        return redirect()->route('akazi.index')->with('success', 'Akazi deleted successfully!');
    }
}