<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/test', [AuthController::class, 'test']);
Route::get('/users', [AuthController::class, 'users']);
Route::get('/users/{id}', [AuthController::class, 'user']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/profile', [AuthController::class, 'profile']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->put('/profile',[AuthController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->post('/profile/avatar',[AuthController::class, 'uploadAvatar']);
