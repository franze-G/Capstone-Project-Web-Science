<?php

use App\Http\Controllers\ClientController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Show registration form
Route::get('register', [ClientController::class, 'showRegistrationForm'])->name('register.form');

// Handle registration
Route::post('register', [ClientController::class, 'register'])->name('register');

// Redirect based on user role
Route::get('/home', [ClientController::class, 'index'])->name('client.dashboard');
Route::get('freelance/home', [ClientController::class, 'index'])->name('freelancer.home');
