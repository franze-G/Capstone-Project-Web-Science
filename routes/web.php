<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamInviteController;
use App\Mail\TeamInvitation;
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
Route::middleware('auth')->group(function () {
    Route::get('/home', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('freelance/home', [ClientController::class, 'index'])->name('freelancer.home');
    Route::get('freelance/teams', [ClientController::class, 'freelancerTeams'])->name('freelancer.teams');
    Route::get('freelance/tasks', [ClientController::class, 'freelancerTasks'])->name('freelancer.tasks');

    Route::post('/team/{teamId}/add-user', [ClientController::class, 'addUserToTeam'])->name('team.addUser');
    Route::get('/team/{teamId}/members', [ClientController::class, 'showTeamMembers'])->name('team.members');

    Route::get('/teams', [ClientController::class, 'teamIndex'])->name('teams.index');
    Route::put('/teams/{team}/recover', [ClientController::class, 'recoverTeam'])->name('teams.recover');

    Route::get('/team/invite', [TeamInviteController::class, 'index'])->name('team.invite');

    Route::get('/team-invitations/accept/{invitation}', [TeamInviteController::class, 'accept'])->name('team-invitation.accept');

    Route::delete('/team-invitations/{invitation}', [TeamInviteController::class, 'destroy'])->name('team-invitation.destroy');

    Route::post('/projects', [ProjectController::class, 'save'])->name('projects.save');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
});
