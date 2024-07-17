<?php

use Spatie\Tags\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideoController;


Route::get('/', function () {
    return view('welcome');
});

Route::view('login', 'auth.login');
// Route::view('register', 'auth.register');

Route::get('profile', function () {
    $user = Auth::user();
    return view('auth.profile', compact('user'));
})->middleware('auth');

Route::prefix('videos')->middleware('auth')->group(function () {
    Route::get('create', [VideoController::class, 'create']);
    Route::get('update/{id}', [VideoController::class, 'edit']);
});
