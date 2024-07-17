<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideoController;

// User Authentication
// Route::post('/register', [AuthController::class, 'register'])->name('auth.api.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.api.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.api.logout');
Route::put('/profile', [AuthController::class, 'updateProfile'])->name('auth.api.update.profile');

// Video
Route::apiResource('videos', VideoController::class);
