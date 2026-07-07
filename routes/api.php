<?php

use App\Http\Controllers\Api\AppliedJobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SavedJobController;
use App\Http\Controllers\Api\DashboardController;

// ---------------------------
// ផ្លូវមិនត្រូវការចូលប្រើ
// ---------------------------
Route::get('/test', [AuthController::class, 'test']);
Route::get('/users', [AuthController::class, 'users']);
Route::get('/users/{id}', [AuthController::class, 'user']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login'); // ✅ បន្ថែមឈ្មោះផ្លូវ ដើម្បីដោះស្រាយកំហុស Route [login] not defined

// ---------------------------
// ផ្លូវត្រូវការផ្ទៀងផ្ទាត់សិទ្ធិ (Sanctum)
// ---------------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::post('/profile/avatar', [AuthController::class, 'uploadAvatar']);

    // ✅ ផ្លូវគ្រប់គ្រងការងារដែលបានរក្សាទុក
    Route::post('/saved-jobs/toggle', [SavedJobController::class, 'toggle']);
    Route::get('/saved-jobs', [SavedJobController::class, 'index']);
    Route::delete('/saved-jobs/{id}', [SavedJobController::class, 'destroy']);
    Route::delete('/saved-jobs', [SavedJobController::class, 'clear']);
    Route::post('/applied-jobs', [AppliedJobController::class, 'store']);
    Route::get('/applied-jobs', [AppliedJobController::class, 'index']);
    Route::delete('/applied-jobs/{id}', [AppliedJobController::class, 'destroy']);
    Route::delete('/applied-jobs', [AppliedJobController::class, 'clear']);
    Route::patch('/applied-jobs/{id}/status', [AppliedJobController::class, 'updateStatus']);
    Route::patch('/applied-jobs/{id}/notes', [AppliedJobController::class, 'updateNotes']);
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);

});
