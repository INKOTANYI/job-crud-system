<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AkaziController;
use App\Http\Controllers\NewRegistrationController;
use App\Http\Controllers\NewApplicationController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Auth::routes();

// Public routes
Route::get('/', [NewApplicationController::class, 'create'])->name('welcome');
Route::post('/applications', [NewApplicationController::class, 'store'])->name('applications.store');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');
Route::get('/districts', [NewApplicationController::class, 'getDistrictsByProvince'])->name('districts.by_province');
Route::get('/sectors', [NewApplicationController::class, 'getSectorsByDistrict'])->name('sectors.by_district');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job_id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/job/{job_id}/apply', [JobController::class, 'apply'])->name('job.apply');
Route::get('/registrations/check-email', [RegistrationController::class, 'checkEmail'])->name('registrations.check-email');
Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');

// New Registration routes (public)
Route::get('/register', [NewRegistrationController::class, 'create'])->name('newregistrations.create');
Route::post('/newregistrations', [NewRegistrationController::class, 'store'])->name('newregistrations.store');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export/pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.export.pdf');

    // New Registrations
    Route::get('/new-registrations', [NewRegistrationController::class, 'index'])->name('new-registrations.index');

    // Contacts
    Route::get('/contact-us', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/ajax', [ContactController::class, 'ajax'])->name('contacts.ajax');

    // Company routes
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{id}', [ContactController::class, 'update'])->name('companies.update'); // Fixed typo
    Route::delete('/companies/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');

    // Job routes
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job_id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job_id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job_id}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // Registration routes
    Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('registrations/create', [RegistrationController::class, 'create'])->name('registrations.create');
    Route::get('registrations/{registration}', [RegistrationController::class, 'edit'])->name('registrations.edit');
    Route::put('registrations/{registration}', [RegistrationController::class, 'update'])->name('registrations.update');
    Route::delete('registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
    Route::get('registrations/{registration}/download', [RegistrationController::class, 'download'])->name('registrations.download');
    Route::get('registrations/download-all', [RegistrationController::class, 'downloadAll'])->name('registrations.downloadAll');

    // Akazi routes
    Route::resource('akazi', AkaziController::class);
});
