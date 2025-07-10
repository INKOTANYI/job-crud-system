<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Province;
use App\Models\District;
use App\Models\Sector;
use App\Models\NewApplication;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NewApplicationController extends Controller
{
    public function create()
    {
        try {
            $departments = Department::all();
            $provinces = Province::all();
            return view('welcome', compact('departments', 'provinces'));
        } catch (\Exception $e) {
            Log::error('Error in NewApplicationController::create: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'phone' => ['required', 'string', 'regex:/^(?:\+250|07)[0-9]{8}$/', 'unique:new_applications,phone'],
                'email' => 'required|email|unique:new_applications,email',
                'id_number' => 'required|string|size:16|regex:/^[0-9]{16}$/|unique:new_applications,id_number',
                'department_id' => 'required|exists:departments,id',
                'province_id' => 'required|exists:provinces,id',
                'district_id' => 'required|exists:districts,id',
                'sector_id' => 'required|exists:sectors,id',
                'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'degree' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'id_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = $request->only([
                'full_name', 'phone', 'email', 'id_number', 'department_id',
                'province_id', 'district_id', 'sector_id'
            ]);

            if ($request->hasFile('cv')) {
                $data['cv'] = $request->file('cv')->store('uploads/cvs', 'public');
            }
            if ($request->hasFile('degree')) {
                $data['degree'] = $request->file('degree')->store('uploads/degrees', 'public');
            }
            if ($request->hasFile('id_doc')) {
                $data['id_doc'] = $request->file('id_doc')->store('uploads/id_docs', 'public');
            }

            NewApplication::create($data);
            $name = explode(' ', trim($request->input('full_name')))[0] ?? 'Applicant';
            return response()->json([
                'success' => true,
                'message' => "Thank you $name for applying! We have your documents and will contact you when needed."
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in NewApplicationController::store: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function getDistrictsByProvince(Request $request)
    {
        try {
            $provinceId = $request->query('province_id');
            $districts = District::where('province_id', $provinceId)->select('id', 'name')->get();
            return response()->json($districts);
        } catch (\Exception $e) {
            Log::error('Error in getDistrictsByProvince: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch districts'], 500);
        }
    }

    public function getSectorsByDistrict(Request $request)
    {
        try {
            $districtId = $request->query('district_id');
            $sectors = Sector::where('district_id', $districtId)->select('id', 'name')->get();
            return response()->json($sectors);
        } catch (\Exception $e) {
            Log::error('Error in getSectorsByDistrict: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch sectors'], 500);
        }
    }

    public function contact(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            return response()->json(['message' => 'Message sent successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error in NewApplicationController::contact: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
