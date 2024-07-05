<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $userName = Auth::user()->firstname;
    $position = Auth::user()->position;
    return view('dashboard', ['userName' => $userName, 'position' => $position]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tasks', [TaskController::class, 'index'])->name('addtask');

Route::post('/tasks', [TaskController::class, 'AddTask'])->name('addtask.post'); // for form submission.

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
