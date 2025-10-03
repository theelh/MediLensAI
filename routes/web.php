<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileWebController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorValidationController;
use App\Http\Controllers\PatientWebController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware(RoleMiddleware::class . ':doctor')->group(function () {
        Route::get('/doctor/upload-certificate', [DoctorController::class, 'showCertificationForm'])->name('doctor.certificate.form');
        Route::post('/doctor/upload-certificate', [DoctorController::class, 'uploadCertificate'])->name('doctor.certificate.upload');
        Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
    });

    Route::middleware(RoleMiddleware::class . ':patient')->group(function () {
        Route::get('/patient/dashboard', [PatientWebController::class, 'index'])->name('dashboard');
        // File routes
        Route::get('/files', [FileWebController::class, 'file'])->name('files.index');
        Route::post('/files', [FileWebController::class, 'store'])->name('files.store');
        Route::get('/files/all', [FileWebController::class, 'all'])->name('files.all');
        Route::get('/files/{file}', [FileWebController::class, 'show'])->name('files.show');
        // Patient routes
        Route::get('/patients', [PatientWebController::class, 'index'])->name('patients.index');
        Route::post('/patients', [PatientWebController::class, 'store'])->name('patients.store');
        Route::delete('/patients/{patient}', [PatientWebController::class, 'destroy'])->name('patients.destroy');
    });    


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(RoleMiddleware::class . ':admin')->group(function () {
        Route::get('/admin/doctors', [DoctorValidationController::class, 'index'])->name('admin.doctors.index');
        Route::post('/admin/doctors/{user}/validate', [DoctorValidationController::class, 'validateDoctor'])->name('admin.doctors.validate');
        Route::post('/admin/doctors/{user}/unvalidated', [DoctorValidationController::class, 'unvalidateDoctor'])->name('admin.doctors.unvalidate');
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });

require __DIR__.'/auth.php';
