<?php

use App\Http\Controllers\FreelanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/calendar-tasks', [FreelanceController::class, 'getTasksForCalendar']);



