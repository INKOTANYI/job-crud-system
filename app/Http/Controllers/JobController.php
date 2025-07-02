<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use App\Models\Province;
use App\Models\Department;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Job::with(['province', 'district', 'department']);

            // Search filters
            if ($request->search && $request->search['value']) {
                $searchValue = $request->search['value'];
                $query->where(function ($q) use ($searchValue) {
                    $q->where('job_title', 'like', "%{$searchValue}%")
                      ->orWhere('job_description', 'like', "%{$searchValue}%")
                      ->orWhereHas('company', function ($q) use ($searchValue) {
                          $q->where('company_name', 'like', "%{$searchValue}%");
                      });
                });
            }

            // Additional filters from search form
            if ($request->keyword) {
                $query->where(function ($q) use ($request) {
                    $q->where('job_title', 'like', "%{$request->keyword}%")
                      ->orWhere('job_description', 'like', "%{$request->keyword}%");
                });
            }
            if ($request->category) {
                $query->where('category_id', $request->category); // Adjust if category is a relationship
            }
            if ($request->location) {
                $query->whereHas('province', function ($q) use ($request) {
                    $q->where('id', $request->location);
                })->orWhereHas('district', function ($q) use ($request) {
                    $q->where('id', $request->location);
                });
            }

            // Filter by job type or featured
            $filters = ['full_time', 'part_time', 'internship', 'freelance', 'tenders'];
            if ($request->filter === 'featured') {
                $query->where('featured', true);
            } elseif (in_array($request->filter, $filters)) {
                $query->where('job_type', $request->filter);
            }

            $totalRecords = Job::count();
            $filteredRecords = $query->count();

            $jobs = $query->with('company') // Added company relationship for logo and name
                          ->skip($request->start ?? 0)
                          ->take($request->length ?? 5)
                          ->get();

            Log::info('DataTable Response', [
                'start' => $request->start,
                'length' => $request->length,
                'total' => $totalRecords,
                'filtered' => $filteredRecords,
                'data' => $jobs->toArray()
            ]);

            return response()->json([
                'draw' => $request->draw ?? 1,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $jobs
            ]);
        }

        // For /jobs page, fetch all jobs with company relationship
        $jobs = Job::with(['company', 'province', 'district'])
                   ->whereIn('job_type', ['full_time', 'part_time', 'internship', 'freelance', 'tenders'])
                   ->orWhere('featured', true)
                   ->get();

        $departments = Department::all();
        $provinces = Province::all();

        return view('welcome', compact('jobs', 'departments', 'provinces')); // Changed to 'welcome' view
    }

    // [Keep all other methods unchanged: create, store, show, edit, update, destroy, apply]
    public function create()
    {
        $companies = Company::all();
        $provinces = Province::all();
        $departments = Department::all();
        return view('jobs.create', compact('companies', 'provinces', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string|max:1000',
            'job_qualification' => 'required|string|max:1000',
            'company_id' => 'required|exists:companies,id',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'sector_id' => 'required|exists:sectors,id',
            'department_id' => 'required|exists:departments,id',
            'job_deadline' => 'required|date|after:today',
            'job_type' => 'required|in:full_time,part_time,internship,scholarship,tenders',
            'featured' => 'boolean',
        ]);

        $job = Job::create($validated);

        return response()->json(['message' => 'Job created successfully.', 'success' => true, 'job' => $job], 201);
    }

    public function show($job_id)
    {
        $job = Job::with(['company', 'province', 'district', 'sector', 'department'])->findOrFail($job_id);
        return view('jobs.show', compact('job'));
    }

    public function edit($job_id)
    {
        $job = Job::findOrFail($job_id);
        $companies = Company::all();
        $provinces = Province::all();
        $departments = Department::all();
        return view('jobs.edit', compact('job', 'companies', 'provinces', 'departments'));
    }

    public function update(Request $request, $job_id)
    {
        $job = Job::findOrFail($job_id);

        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string|max:1000',
            'job_qualification' => 'required|string|max:1000',
            'company_id' => 'required|exists:companies,id',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'sector_id' => 'required|exists:sectors,id',
            'department_id' => 'required|exists:departments,id',
            'job_deadline' => 'required|date|after:today',
            'job_type' => 'required|in:full_time,part_time,internship,scholarship,tenders',
            'featured' => 'boolean',
        ]);

        $job->update($validated);

        return response()->json(['success' => true, 'message' => 'Job updated successfully.', 'job' => $job]);
    }

    public function destroy($job_id)
    {
        $job = Job::findOrFail($job_id);
        $job->delete();

        return response()->json(['success' => true, 'message' => 'Job deleted successfully.']);
    }

    public function apply($id)
    {
        $job = Job::findOrFail($id);
        $email = request()->query('email');
        $registration = null;

        if ($email) {
            $registration = Registration::where('email', $email)->first();
        }

        return view('jobs.apply', compact('job', 'registration'));
    }
}