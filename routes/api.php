<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth actions
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    // Resource routes
    Route::post('/projects/{project}/users', [ProjectController::class, 'syncUsers']);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('users', UserController::class);
});

// Test route
Route::get('/test', function () {
    return response()->json(['message' => 'Hello from Laravel API!']);
});
