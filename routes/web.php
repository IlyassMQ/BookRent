<?php
use App\Http\Controllers\AuthController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboards
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function() {
        return view('dashboards.admin');
    });
});

Route::middleware(['auth', 'role:library'])->group(function () {
    Route::get('/library', function() {
        return view('dashboards.library');
    });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboards.user');
    });
});