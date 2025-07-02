<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('applications.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:jobs,job_id',
            'registration_id' => 'required|exists:registrations,id',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        Application::create($validated);
        return response()->json(['success' => true]);
    }
}