<?php

use App\Http\Controllers\ClientController;
use App\Mail\TeamInvitation;
use App\Models\User;
use App\Http\Controllers\FreelanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamInviteController;
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

    //index ng client and freelance
    Route::middleware('auth')->group(function () {

    //for clients
    Route::get('/dashboard', [ClientController::class, 'index'])->name('dashboard');
    Route::get('client/teams', [ClientController::class, 'teams'])->name('client.teams');
    Route::get('/activities', [ClientController::class, 'activityView'])->name('activity.index');
    Route::get('client/freelance-display', [ClientController::class, 'displayRegisteredFreelancers'])->name('client.freelance-display');

    //for freelancers
        
    Route::get('freelance/home', [ClientController::class, 'index'])->name('freelancer.home');
    Route::get('freelance/teams', [ClientController::class, 'teams'])->name('freelancer.teams');
    Route::get('freelance/tasks', [FreelanceController::class, 'freelancerTasks'])->name('freelancer.tasks');

    Route::post('/team/{teamId}/add-user', [ClientController::class, 'addUserToTeam'])->name('team.addUser');
    Route::get('/team/{teamId}/members', [ClientController::class, 'showTeamMembers'])->name('team.members');

    Route::get('/teams', [ClientController::class, 'teamIndex'])->name('teams.index');
    Route::put('/teams/{team}/recover', [ClientController::class, 'recoverTeam'])->name('teams.recover');

    Route::get('/team/invite', [TeamInviteController::class, 'index'])->name('team.invite');

    //accept and decline ng team invite
    Route::get('/team-invitations/accept/{invitation}', [TeamInviteController::class, 'accept'])->name('team-invitation.accept');
    Route::delete('/team-invitations/{invitation}', [TeamInviteController::class, 'destroy'])->name('team-invitation.destroy');

    //creating ng task
    Route::post('/projects', [ProjectController::class, 'save'])->name('projects.save');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    //modals and task counts
    Route::get('/tasks', [FreelanceController::class, 'index'])->name('tasks.index');

    Route::post('/freelance/tasks/{id}/start', [FreelanceController::class, 'startTask'])->name('tasks.start');
    Route::post('/freelance/tasks/{id}/complete', [FreelanceController::class, 'completeTask'])->name('tasks.complete');

    Route::get('/task-counts', [FreelanceController::class, 'taskCounts'])->name('task.counts');
    // for details ng tasks
    Route::get('/tasks/{id}', [FreelanceController::class, 'getTaskDetails']);

    // Add this to your routes file
    Route::post('/tasks/{id}/verify', [ProjectController::class, 'verifyTask'])->name('tasks.verify');

    Route::post('/pay', [PaymentController::class, 'pay'])->name('payment.pay');
});

    //route for freelance
    Route::get('freelance/teams', [ClientController::class, 'freelancerTeams'])->name('freelancer.teams');
    Route::get('freelance/tasks', [ClientController::class, 'freelancerTasks'])->name('freelancer.tasks');

    Route::post('/team/{teamId}/add-user', [ClientController::class, 'addUserToTeam'])->name('team.addUser');
    Route::get('/team/{teamId}/members', [ClientController::class, 'showTeamMembers'])->name('team.members');

    Route::get('/teams', [ClientController::class, 'teamIndex'])->name('teams.index');
    Route::put('/teams/{team}/recover', [ClientController::class, 'recoverTeam'])->name('teams.recover');

    Route::get('/team/invite', [TeamInviteController::class, 'index'])->name('team.invite');

    //accept and decline ng team invite
    Route::get('/team-invitations/accept/{invitation}', [TeamInviteController::class, 'accept'])->name('team-invitation.accept');
    Route::delete('/team-invitations/{invitation}', [TeamInviteController::class, 'destroy'])->name('team-invitation.destroy');

    //creating ng task
    Route::post('/projects', [ProjectController::class, 'save'])->name('projects.save');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    //modals and task counts
    Route::get('/tasks', [FreelanceController::class, 'index'])->name('tasks.index');
    
    Route::post('/freelance/tasks/{id}/start', [FreelanceController::class, 'startTask'])->name('tasks.start');
    Route::post('/freelance/tasks/{id}/complete', [FreelanceController::class, 'completeTask'])->name('tasks.complete');
    
    Route::get('/task-counts', [FreelanceController::class, 'taskCounts'])->name('task.counts');
    
    // for details ng tasks
    Route::get('/tasks/{id}', [FreelanceController::class, 'getTaskDetails']);

    Route::get('/activities', [ClientController::class, 'activityView'])->name('activity.index');
    // Add this to your routes file
    Route::post('/tasks/{id}/verify', [ProjectController::class, 'verifyTask'])->name('tasks.verify');

    Route::post('/pay', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::post('/payment/callback', [PaymentController::class, 'handlePaymentCallback'])->name('payment.callback');

    Route::post('rate-user/{userId}', [ClientController::class, 'rateUser']);
    Route::get('user-rating/{id}', [ClientController::class, 'getUserRating']);

    Route::get('/user/{userId}/profile', [ClientController::class, 'viewProfile'])->name('user.profile');
});
