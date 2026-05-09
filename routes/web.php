<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ModuleController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']); // Fallback for simple link

// Protected routes for all authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/materi', [ModuleController::class, 'publicIndex'])->name('materi');
    Route::get('/simulasi', function () {
        return view('simulation');
    })->name('simulasi');
});

// Admin only routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('dashboard.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin');
    
    Route::resource('modules', ModuleController::class);
});
