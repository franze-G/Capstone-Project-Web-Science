<?php

use App\Http\Controllers\Auth\ClientAuthController;
use App\Http\Controllers\Auth\FreelancerAuthController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Client Routes
Route::prefix('client')->name('client.')->group(function () {
    Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ClientAuthController::class, 'login']);
    Route::get('/register', [ClientAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [ClientAuthController::class, 'register']);
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('logout');
    
    Route::middleware('auth:client')->group(function () {
        Route::get('/dashboard', [ClientAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [ClientAuthController::class, 'showProfile'])->name('profile');
        // Route::put('/profile', [ClientAuthController::class, 'updateProfile'])->name('profile.update');
    });
});

// Freelancer Routes
Route::prefix('freelancer')->name('freelancer.')->group(function () {
    Route::get('/login', [FreelancerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [FreelancerAuthController::class, 'login']);
    Route::get('/register', [FreelancerAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [FreelancerAuthController::class, 'register']);
    Route::post('/logout', [FreelancerAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [FreelancerAuthController::class, 'dashboard'])->name('dashboard')->middleware('auth.freelancer');
});
