<?php

namespace App\Http\Controllers;

use App\Models\NewApplication;
use App\Models\Contact;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Counts
            $newRegistrationCount = NewApplication::count();
            $contactCount = Contact::count();

            // Recent registrations
            $recentRegistrations = NewApplication::with(['department', 'province', 'district', 'sector'])
                ->latest()
                ->take(10)
                ->get();

            return view('dashboard', compact(
                'newRegistrationCount',
                'contactCount',
                'recentRegistrations'
            ));
        } catch (\Exception $e) {
            \Log::error('Dashboard Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the dashboard.');
        }
    }

    public function exportPdf()
    {
        try {
            $data = [
                'newRegistrationCount' => NewApplication::count(),
                'contactCount' => Contact::count(),
                'recentRegistrations' => NewApplication::with(['department', 'province', 'district', 'sector'])
                    ->latest()
                    ->take(10)
                    ->get(),
            ];

            $pdf = Pdf::loadView('reports.pdf', $data);
            return $pdf->download('dashboard_report_' . now()->format('Ymd_His') . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF Export Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to export PDF.');
        }
    }
}
