<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileWebController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorValidationController;
use App\Http\Controllers\PatientWebController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SubscriptionController;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/pricing', [WelcomeController::class, 'pricin'])->name('pricing');
Route::get('/about', [WelcomeController::class, 'about'])->name('about');
Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');
Route::post('/contact', [WelcomeController::class, 'send'])->name('contact.send');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/plans', [SubscriptionController::class, 'Chooseplans'])->name('subscription.choose');
    Route::get('/subscribe', [SubscriptionController::class, 'createCheckoutSession'])->name('subscription.create');
    Route::get('/subscription/success', [SubscriptionController::class, 'success'])->name('subscription.success');
    Route::get('/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::get('/subscription/cancelPlan', [SubscriptionController::class, 'cancelPlan'])->name('subscription.cancelPlan');
    Route::get('/subscription/show', [SubscriptionController::class, 'show'])->name('subscription.show');

    // Question & Answer routes
    Route::resource('questions', QuestionController::class)->only(['index','create','store','show']);
    Route::post('questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');


    Route::middleware(RoleMiddleware::class . ':doctor')->group(function () {
        Route::get('/doctor/upload-certificate', [DoctorController::class, 'showCertificationForm'])->name('doctor.certificate.form');
        Route::post('/doctor/upload-certificate', [DoctorController::class, 'uploadCertificate'])->name('doctor.certificate.upload');
        Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
    });

    Route::middleware(RoleMiddleware::class . ':patient')->group(function () {
        // File routes
        Route::get('/files', [FileWebController::class, 'index'])->name('files.index');
        Route::post('/files', [FileWebController::class, 'store'])->name('files.store');
        Route::get('/files/all', [FileWebController::class, 'all'])->name('files.all');
        Route::get('/files/{file}', [FileWebController::class, 'show'])->name('files.show');
        Route::delete('/files/{file}', [FileWebController::class, 'destroy'])->name('files.destroy');

        //Dashboard
        Route::get('/patient/dashboard', [PatientWebController::class, 'index'])->name('dashboard');
        Route::get('/patient/service', [PatientWebController::class, 'service'])->name('service');

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
