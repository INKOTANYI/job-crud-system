<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Province;
use App\Models\JobCategory;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with(['jobCategory', 'province', 'district', 'sector'])->get();
        $provinces = Province::all();
        $jobCategories = JobCategory::all();
        return view('companies', compact('companies', 'provinces', 'jobCategories'));
    }

    public function create()
    {
        $provinces = Province::all();
        return view('companies-create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|file|image|max:2048',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:job_categories,id',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'sector_id' => 'required|exists:sectors,id',
        ]);

        $companyData = $validated;

        // Auto-generate location from province, district, and sector
        $province = Province::find($validated['province_id']);
        $district = \App\Models\District::find($validated['district_id']);
        $sector = \App\Models\Sector::find($validated['sector_id']);
        $companyData['location'] = "{$province->name} {$district->name} {$sector->name}";

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $companyData['logo'] = $logoPath;
        }

        $company = Company::create($companyData)->load('jobCategory', 'province', 'district', 'sector');

        return response()->json([
            'message' => 'Company created successfully!',
            'company' => $company,
        ], 201);
    }

    public function edit($id)
    {
        $company = Company::with(['jobCategory', 'province', 'district', 'sector'])->findOrFail($id);
        $provinces = Province::all();
        $jobCategories = JobCategory::all();
        return view('companies-edit', compact('company', 'provinces', 'jobCategories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|file|image|max:2048',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:job_categories,id',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'sector_id' => 'required|exists:sectors,id',
        ]);

        $company = Company::findOrFail($id);
        $companyData = $validated;

        // Auto-generate location from province, district, and sector
        $province = Province::find($validated['province_id']);
        $district = \App\Models\District::find($validated['district_id']);
        $sector = \App\Models\Sector::find($validated['sector_id']);
        $companyData['location'] = "{$province->name} {$district->name} {$sector->name}";

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $companyData['logo'] = $logoPath;
        }

        $company->update($companyData);
        $company->load('jobCategory', 'province', 'district', 'sector');

        return response()->json([
            'message' => 'Company updated successfully!',
            'company' => $company,
        ]);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return response()->json([
            'message' => 'Company deleted successfully!',
            'id' => $id,
        ]);
    }
}
