<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\InsightController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/files', [FileController::class, 'store']);

    Route::apiResource('patients', PatientController::class);
    Route::apiResource('insights', InsightController::class);

    Route::get('/files/{file}/status', [FileController::class, 'status']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // User profile accessible directement sans email vérification
    Route::get('/user-profile', function (Request $request) {
        return response()->json($request->user());
    });
});
