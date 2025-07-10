<?php

namespace App\Http\Controllers;

use App\Models\NewApplication; // Assuming registrations relate to NewApplication
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = NewApplication::all();
        return view('registrations.index', compact('registrations'));
    }

    public function create()
    {
        return view('registrations.create');
    }

    public function store(Request $request)
    {
        // Placeholder: Use NewApplication store logic if applicable
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        NewApplication::create($request->only(['full_name', 'email', 'phone']));

        return redirect()->route('registrations.index')->with('success', 'Registration created.');
    }

    public function edit($registration)
    {
        $registration = NewApplication::findOrFail($registration);
        return view('registrations.edit', compact('registration'));
    }

    public function update(Request $request, $registration)
    {
        $registration = NewApplication::findOrFail($registration);
        $registration->update($request->only(['full_name', 'email', 'phone']));
        return redirect()->route('registrations.index')->with('success', 'Registration updated.');
    }

    public function destroy($registration)
    {
        $registration = NewApplication::findOrFail($registration);
        $registration->delete();
        return redirect()->route('registrations.index')->with('success', 'Registration deleted.');
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = NewApplication::where('email', $email)->exists();
        return response()->json(['exists' => $email]);
    }

    public function download($registration)
    {
        // Implement file download logic if needed
        return redirect()->back();
    }

    public function downloadAll()
    {
        // Implement bulk download logic if needed
        return redirect()->back();
    }
}
