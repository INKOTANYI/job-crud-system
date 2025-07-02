<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Job;
use App\Models\Applicable;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $companyCount = Company::count();
        $jobCount = Job::count();
        $applicationCount = Applicable::count(); // Count from applicables table

        // Fetch recent jobs and applications (limit to 5 for preview)
        $recentJobs = Job::with('company')->latest()->take(5)->get();
        $recentApplications = Applicable::with('job')->latest()->take(5)->get();

        return view('dashboard', compact(
            'userCount',
            'companyCount',
            'jobCount',
            'applicationCount',
            'recentJobs',
            'recentApplications'
        ));
    }
}