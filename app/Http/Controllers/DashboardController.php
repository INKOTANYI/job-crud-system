<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Job;
use App\Models\Applicable;
use App\Models\NewRegistration; // Assuming this is your model for new registrations
use App\Models\Contact; // Assuming this is your model for contact us SMS

class DashboardController extends Controller
{
    public function index()
    {
        $applicationCount = Applicable::count(); // Total new applications
        $newRegistrationCount = NewRegistration::count(); // Total new registrations
        $contactCount = Contact::count(); // Total SMS from contact us

        // Fetch recent applications and new registrations (limit to 5 for preview)
        $recentApplications = Applicable::with('job')->latest()->take(5)->get();
        $recentNewRegistrations = NewRegistration::latest()->take(5)->get();

        // Data for graph (group by district and department)
        $applicationByDistrict = Applicable::select('district_id', \DB::raw('count(*) as total'))
            ->groupBy('district_id')
            ->with('district') // Assuming a relationship with districts
            ->get();
        $applicationByDepartment = Applicable::select('department_id', \DB::raw('count(*) as total'))
            ->groupBy('department_id')
            ->with('department') // Assuming a relationship with departments
            ->get();

        return view('dashboard', compact(
            'applicationCount',
            'newRegistrationCount',
            'contactCount',
            'recentApplications',
            'recentNewRegistrations',
            'applicationByDistrict',
            'applicationByDepartment'
        ));
    }
}