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
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportAdminController;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/pricing', [WelcomeController::class, 'pricin'])->name('pricing');
Route::get('/about', [WelcomeController::class, 'about'])->name('about');
Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');
Route::post('/contact', [WelcomeController::class, 'send'])->name('contact.send');


Route::middleware(['auth', 'verified'])->group(function () {

    // Question report
    Route::post('/questions/{id}/report', [QuestionController::class, 'report'])->name('questions.report');

    //File report
    Route::post('/report/{file}', [ReportController::class, 'store'])->name('report.store');

    // Post routes
    Route::get('/posts/feed', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');
    Route::post('/posts/{post}/comment', [PostController::class, 'storeComment'])->name('posts.comment');
    Route::get('/posts/{post}/comments', [PostController::class, 'loadComments'])->name('posts.loadComments');


    Route::get('/question/feed', [PatientWebController::class, 'publicFeed'])->name('patient.feed');
    Route::get('/files/feed', [PatientWebController::class,'fileFeed'])->name('files.feed');
    Route::post('/files/{id}/like', [PatientWebController::class,'toggleLike']);
    Route::post('/files/{id}/comment', [PatientWebController::class,'storeComment']);
    Route::get('/files/{file}/comments', [PatientWebController::class, 'loadFileComments'])->name('files.loadComments');

    Route::post('/questions/{id}/like', [QuestionController::class, 'toggleLike'])
    ->name('questions.like');

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
        // Post routes for doctors
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');
        Route::post('/posts/{post}/comment', [PostController::class, 'storeComment'])->name('posts.comment');

        Route::get('/doctor/upload-certificate', [DoctorController::class, 'showCertificationForm'])->name('doctor.certificate.form');
        Route::post('/doctor/upload-certificate', [DoctorController::class, 'uploadCertificate'])->name('doctor.certificate.upload');
        Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
    });

    Route::middleware(RoleMiddleware::class . ':patient')->group(function () {
        // File routes
        Route::get('/files', [FileWebController::class, 'index'])->name('files.index');
        Route::post('/files', [FileWebController::class, 'store'])->name('files.store');
        Route::get('/files/all', [FileWebController::class, 'all'])->name('files.all');
        Route::get('/filles/{file}', [FileWebController::class, 'show'])->name('files.showe');
        Route::delete('/filles/{file}', [FileWebController::class, 'destroy'])->name('files.destroye');

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
        // System Health
        Route::get('/system/health', [AdminController::class, 'systemHealth'])->name('admin.system.health');

        // Users CRUD
        Route::get('/users', [AdminController::class, 'userIndex'])->name('users.index');
        Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

        // Reports Management
        Route::get('/admin/reports', [ReportAdminController::class, 'index'])->name('admin.reports.index');
        Route::post('/admin/reports/{report}/review', [ReportAdminController::class, 'review'])->name('admin.reports.review');
        Route::delete('/admin/reports/{report}', [ReportAdminController::class, 'destroy'])->name('admin.reports.destroy');

        Route::get('/admin/quesreports', [ReportAdminController::class, 'quesindex'])->name('admin.reportsques.index');
        Route::delete('/admin/quesreports/{id}', [ReportAdminController::class, 'quesdestroy'])->name('admin.reportsques.destroy');
        Route::get('/admin/report/question/{id}', [ReportAdminController::class, 'show'])
            ->name('admin.reportsques.show');

        // Delete Question
        Route::delete('/admin/report/question/{id}', [ReportAdminController::class, 'destroyQuestion'])
            ->name('admin.question.delete');


        // Files CRUD
        Route::get('/files', [AdminController::class, 'fileIndex'])->name('files.index');
        Route::get('/files/{file}', [AdminController::class, 'show'])->name('files.show');
        Route::delete('/files/{file}', [AdminController::class, 'fileDestroy'])->name('files.destroy');
        Route::delete('/admin/comments/{id}', [AdminController::class, 'comtdestroy'])->name('admin.comments.destroy');
        Route::delete('/admin/postcomments/{id}', [AdminController::class, 'comtpostdestroy'])->name('admin.pscomments.destroy');

        // Payments Management
        Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('admin.subscriptions.index');
        Route::post('subscriptions/{user}/toggle', [SubscriptionController::class, 'toggle'])->name('admin.subscriptions.toggle');

        // Posts CRUD
        Route::get('/posts', [AdminController::class, 'postIndex'])->name('posts.index');
        Route::get('/posts/{post}', [AdminController::class, 'postShow'])->name('posts.show');
        Route::delete('/posts/{post}', [AdminController::class, 'postDestroy'])->name('posts.destroy');

        Route::get('/admin/doctors', [DoctorValidationController::class, 'index'])->name('admin.doctors.index');
        Route::post('/admin/doctors/{user}/validate', [DoctorValidationController::class, 'validateDoctor'])->name('admin.doctors.validate');
        Route::post('/admin/doctors/{user}/unvalidated', [DoctorValidationController::class, 'unvalidateDoctor'])->name('admin.doctors.unvalidate');
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });

require __DIR__.'/auth.php';
