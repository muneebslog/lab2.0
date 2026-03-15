<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SyncController;
use App\Http\Controllers\Api\TestController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Open endpoint: list tests (id, code, short_hand)
Route::get('/tests', [TestController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sync', [SyncController::class, 'sync']);
});
