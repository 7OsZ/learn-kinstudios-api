<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CartMergeController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/health', fn() => response()->json([
        'success' => true,
        'status' => 'healthy',
        'timestamp' => now()->toISOString(),
    ]));

    // Auth (Public + Rate Limited)
    Route::prefix('auth')->group(function () {
        Route::middleware('throttle:auth')->group(function () {
            Route::post('/register', [AuthController::class, 'register']);
            Route::post('/login', [AuthController::class, 'login']);
            Route::post('/demo-login', [AuthController::class, 'demoLogin']);
        });

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/me', [AuthController::class, 'me']);
            Route::post('/logout', [AuthController::class, 'logout']);
        });
    });

    // Protected Cart Merge
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/cart/merge', CartMergeController::class);
    });
});
