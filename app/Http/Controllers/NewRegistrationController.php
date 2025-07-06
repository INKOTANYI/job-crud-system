<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Sector;
use App\Models\NewRegistration;
use Illuminate\Support\Facades\Validator;

class NewRegistrationController extends Controller
{
    public function create()
    {
        $departments = []; // Fetch from DB if needed
        $provinces = []; // Fetch from DB if needed
        $districts = District::all() ?? collect(); // Fallback to empty collection if null
        $sectors = Sector::all() ?? collect(); // Fallback to empty collection if null
        return view('welcome', compact('departments', 'provinces', 'districts', 'sectors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'names' => 'required|string|max:255',
            'phone' => 'required|string|unique:newregistration,phone',
            'email' => 'required|email|unique:newregistration,email',
            'id_number' => 'required|string|max:16|unique:newregistration,id_number',
            'department_id' => 'nullable|exists:departments,id',
            'province_id' => 'nullable|exists:provinces,id',
            'district_id' => 'nullable|exists:districts,id',
            'sector_id' => 'nullable|exists:sectors,id',
            'cv' => 'nullable|file|mimes:pdf,doc,docx',
            'degree' => 'nullable|file|mimes:pdf,doc,docx',
            'id_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['names', 'phone', 'email', 'id_number', 'department_id', 'province_id', 'district_id', 'sector_id']);

        // Handle file uploads
        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('uploads/cvs', 'public');
        }
        if ($request->hasFile('degree')) {
            $data['degree'] = $request->file('degree')->store('uploads/degrees', 'public');
        }
        if ($request->hasFile('id_doc')) {
            $data['id_doc'] = $request->file('id_doc')->store('uploads/id_docs', 'public');
        }

        try {
            NewRegistration::create($data);
            $name = explode(' ', $request->input('names'))[0]; // Get first name
            return response()->json([
                'success' => true,
                'message' => "Thank you Mr. $name for applying! We have your documents and will contact you when needed. Regards"
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred. Please try again.'], 500);
        }
    }
}