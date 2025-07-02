<?php

namespace App\Http\Controllers;

use App\Models\Applicable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicables = Applicable::with(['job', 'department', 'province', 'district', 'sector'])->get();
        return view('applicables.index', compact('applicables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'names' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^(?:\+250|07)\d{8}$/', 'unique:applicables,phone'],
            'email' => ['required', 'email', 'unique:applicables,email'],
            'id_number' => ['required', 'string', 'regex:/^\d{16}$/', 'unique:applicables,id_number'],
            'department_id' => ['required', 'exists:departments,id'],
            'province_id' => ['required', 'exists:provinces,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'sector_id' => ['required', 'exists:sectors,id'],
            'job_id' => ['required', 'exists:jobs,job_id'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'degree' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'id_doc' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ]);

        // Check for existing application for the same job
        $existingApplication = Applicable::where('job_id', $request->job_id)
            ->where(function ($query) use ($request) {
                $query->where('email', $request->email)
                      ->orWhere('id_number', $request->id_number);
            })->first();

        if ($existingApplication) {
            return response()->json(['errors' => ['job_id' => ['You have already applied for this job.']]], 422);
        }

        $data = $request->only(['names', 'phone', 'email', 'id_number', 'department_id', 'province_id', 'district_id', 'sector_id', 'job_id']);

        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('uploads', 'public');
        }
        if ($request->hasFile('degree')) {
            $data['degree'] = $request->file('degree')->store('uploads', 'public');
        }
        if ($request->hasFile('id_doc')) {
            $data['id_doc'] = $request->file('id_doc')->store('uploads', 'public');
        }

        $application = Applicable::create($data);

        return response()->json([
            'application' => $application->load(['department', 'province', 'district', 'sector']),
            'message' => 'Application submitted successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicable  $applicable
     * @return \Illuminate\Http\Response
     */
    public function show(Applicable $applicable)
    {
        $applicable->load(['job', 'department', 'province', 'district', 'sector']);
        return response()->json(['application' => $applicable]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicable  $applicable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicable $applicable)
    {
        $request->validate([
            'names' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^(?:\+250|07)\d{8}$/', 'unique:applicables,phone,' . $applicable->id],
            'email' => ['required', 'email', 'unique:applicables,email,' . $applicable->id],
            'id_number' => ['required', 'string', 'regex:/^\d{16}$/', 'unique:applicables,id_number,' . $applicable->id],
            'department_id' => ['required', 'exists:departments,id'],
            'province_id' => ['required', 'exists:provinces,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'sector_id' => ['required', 'exists:sectors,id'],
            'job_id' => ['required', 'exists:jobs,job_id'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'degree' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'id_doc' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ]);

        $data = $request->only(['names', 'phone', 'email', 'id_number', 'department_id', 'province_id', 'district_id', 'sector_id', 'job_id']);

        if ($request->hasFile('cv')) {
            if ($applicable->cv) Storage::disk('public')->delete($applicable->cv);
            $data['cv'] = $request->file('cv')->store('uploads', 'public');
        }
        if ($request->hasFile('degree')) {
            if ($applicable->degree) Storage::disk('public')->delete($applicable->degree);
            $data['degree'] = $request->file('degree')->store('uploads', 'public');
        }
        if ($request->hasFile('id_doc')) {
            if ($applicable->id_doc) Storage::disk('public')->delete($applicable->id_doc);
            $data['id_doc'] = $request->file('id_doc')->store('uploads', 'public');
        }

        $applicable->update($data);

        return response()->json([
            'application' => $applicable->load(['department', 'province', 'district', 'sector']),
            'message' => 'Application updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicable  $applicable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicable $applicable)
    {
        if ($applicable->cv) Storage::disk('public')->delete($applicable->cv);
        if ($applicable->degree) Storage::disk('public')->delete($applicable->degree);
        if ($applicable->id_doc) Storage::disk('public')->delete($applicable->id_doc);

        $applicable->delete();

        return response()->json(['message' => 'Application deleted successfully'], 200);
    }
}