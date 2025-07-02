<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Registration\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AkaziController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ApplicableController;

// Authentication routes
Auth::routes();

// Public routes
Route::get('/', [JobController::class, 'index'])->name('welcome'); // Welcome page
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index'); // Public job listing
Route::get('/jobs/{job_id}', [JobController::class, 'show'])->name('jobs.show'); // Public job details
Route::get('/job/{id}/apply', [JobController::class, 'apply'])->name('job.apply'); // Public apply route
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store'); // Public contact form
Route::get('/registrations/check-email', [RegistrationController::class, 'checkEmail'])->name('registrations.check-email'); // Public email check
Route::post('registrations', [RegistrationController::class, 'store'])->name('registrations.store'); // Public registration store for applications

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Company routes
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{id}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');

    // Job routes
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job_id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job_id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job_id}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // Registration routes (excluding public store)
    Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('registrations/create', [RegistrationController::class, 'create'])->name('registrations.create');
    Route::get('registrations/{registration}', [RegistrationController::class, 'edit'])->name('registrations.edit');
    Route::put('registrations/{registration}', [RegistrationController::class, 'update'])->name('registrations.update');
    Route::delete('registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
    Route::get('registrations/{registration}/download', [RegistrationController::class, 'download'])->name('registrations.download');
    Route::get('registrations/download-all', [RegistrationController::class, 'downloadAll'])->name('registrations.downloadAll');

    // Akazi routes
    Route::resource('akazi', AkaziController::class);

    // Applicable routes
    Route::get('/applications', [ApplicableController::class, 'index'])->name('applicables.index');
    Route::post('/applications', [ApplicableController::class, 'store'])->name('applicables.store');
    Route::get('/applications/{applicable}', [ApplicableController::class, 'show'])->name('applicables.show');
    Route::put('/applications/{applicable}', [ApplicableController::class, 'update'])->name('applicables.update');
    Route::delete('/applications/{applicable}', [ApplicableController::class, 'destroy'])->name('applicables.destroy');
});