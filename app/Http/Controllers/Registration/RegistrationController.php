<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Department;
use App\Models\Province;
use App\Models\District;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Display a listing of registrations.
     */
    public function index()
    {
        $registrations = Registration::with(['department', 'province', 'district', 'sector'])->get();
        $departments = Department::all();
        $provinces = Province::all();
        $sectors = Sector::all();

        // Prepare districts and sectors dynamically for each registration
        $registrationData = $registrations->map(function ($registration) {
            return [
                'registration' => $registration,
                'districts' => $registration->province_id ? District::where('province_id', $registration->province_id)->get() : collect(),
                'sectors' => $registration->district_id ? Sector::where('district_id', $registration->district_id)->get() : collect(),
            ];
        })->all();

        return view('registration.registrations', compact('registrationData', 'departments', 'provinces', 'sectors'));
    }

    /**
     * Show the form for creating a new registration.
     */
    public function create()
    {
        $departments = Department::all();
        $provinces = Province::all();
        $sectors = Sector::all();
        return view('registration.create', compact('departments', 'provinces', 'sectors'));
    }

    /**
     * Store a newly created registration in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'names' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^(?:\+250|07)\d{8}$/', 'unique:registrations,phone', 'max:13'],
            'email' => ['required', 'email', 'unique:registrations,email', 'max:255'],
            'id_number' => ['required', 'string', 'regex:/^\d{16}$/', 'unique:registrations,id_number', 'max:16'],
            'department_id' => ['required', 'exists:departments,id'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'degree' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'id_doc' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'province_id' => ['required', 'exists:provinces,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'sector_id' => ['required', 'exists:sectors,id'],
            // Removed 'job_id' from validation and logic
        ]);

        // Removed job_id check since it's not in registrations
        $data = $request->only(['names', 'phone', 'email', 'id_number', 'department_id', 'province_id', 'district_id', 'sector_id']);

        // Associate with authenticated user if logged in, otherwise use email as identifier
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('uploads', 'public');
        }
        if ($request->hasFile('degree')) {
            $data['degree'] = $request->file('degree')->store('uploads', 'public');
        }
        if ($request->hasFile('id_doc')) {
            $data['id_doc'] = $request->file('id_doc')->store('uploads', 'public');
        }

        $registration = Registration::create($data);

        return response()->json(['registration' => $registration->load(['department', 'province', 'district', 'sector']), 'message' => 'Registration created successfully'], 201);
    }

    /**
     * Show the form for editing the specified registration.
     */
    public function edit(Registration $registration)
    {
        $districts = $registration->province_id ? District::where('province_id', $registration->province_id)->get() : collect();
        $sectors = $registration->district_id ? Sector::where('district_id', $registration->district_id)->get() : collect();
        return view('registration.edit', compact('registration', 'districts', 'sectors'));
    }

    /**
     * Update the specified registration in storage.
     */
    public function update(Request $request, Registration $registration)
    {
        $request->validate([
            'names' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^(?:\+250|07)\d{8}$/', 'unique:registrations,phone,' . $registration->id, 'max:13'],
            'email' => ['required', 'email', 'unique:registrations,email,' . $registration->id, 'max:255'],
            'id_number' => ['required', 'string', 'regex:/^\d{16}$/', 'unique:registrations,id_number,' . $registration->id, 'max:16'],
            'department_id' => ['required', 'exists:departments,id'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'degree' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'id_doc' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'province_id' => ['required', 'exists:provinces,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'sector_id' => ['required', 'exists:sectors,id'],
            // Removed 'job_id' from validation
        ]);

        $data = $request->only(['names', 'phone', 'email', 'id_number', 'department_id', 'province_id', 'district_id', 'sector_id']);

        if ($request->hasFile('cv')) {
            if ($registration->cv) {
                Storage::disk('public')->delete($registration->cv);
            }
            $data['cv'] = $request->file('cv')->store('uploads', 'public');
        }
        if ($request->hasFile('degree')) {
            if ($registration->degree) {
                Storage::disk('public')->delete($registration->degree);
            }
            $data['degree'] = $request->file('degree')->store('uploads', 'public');
        }
        if ($request->hasFile('id_doc')) {
            if ($registration->id_doc) {
                Storage::disk('public')->delete($registration->id_doc);
            }
            $data['id_doc'] = $request->file('id_doc')->store('uploads', 'public');
        }

        $registration->update($data);

        return response()->json(['registration' => $registration->load(['department', 'province', 'district', 'sector']), 'message' => 'Registration updated successfully'], 200);
    }

    /**
     * Remove the specified registration from storage.
     */
    public function destroy(Registration $registration)
    {
        try {
            if ($registration->cv) {
                Storage::disk('public')->delete($registration->cv);
            }
            if ($registration->degree) {
                Storage::disk('public')->delete($registration->degree);
            }
            if ($registration->id_doc) {
                Storage::disk('public')->delete($registration->id_doc);
            }

            $registration->delete();

            return response()->json(['message' => 'Registration deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete registration: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Download a PDF for the specified registration.
     */
    public function download(Registration $registration)
    {
        try {
            $pdf = PDF::loadView('registration.pdf', compact('registration'));
            return $pdf->download('registration-' . $registration->id . '.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to generate PDF: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Download a PDF for all registrations.
     */
    public function downloadAll()
    {
        try {
            $registrations = Registration::with(['department', 'province', 'district', 'sector'])->get();
            $pdf = PDF::loadView('registration.pdf_all', compact('registrations'));
            return $pdf->download('all-registrations.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to generate PDF: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Check if an email is already registered.
     */
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $ignoreId = $request->input('ignore_id', 0); // For edit case, ignore current registration

        $registration = Registration::where('email', $email)
            ->where('id', '!=', $ignoreId)
            ->first();

        return response()->json([
            'exists' => !!$registration,
            'registration' => $registration ? $registration->only(['id', 'names', 'id_number', 'phone']) + ['department' => $registration->department->name ?? 'N/A'] : null,
            'message' => $registration ? 'Email already registered' : 'Email available'
        ]);
    }
}