<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ClientController extends Controller
{
    // Show registration form with optional role pre-filled
    public function showRegistrationForm(Request $request)
    {
        // Fetch role from query parameters or session
        $userType = $request->query('role') ?? session('user_type');

        return view('auth.register', compact('userType'));
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate the registration data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|string|in:client,freelancer',
        ]);

        // Create a new user
        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        // Log in the newly created user
        Auth::login($user);

        // Redirect based on account type
        if ($user->role === 'client') {
            return redirect()->route('dashboard'); // Redirect to client dashboard
        } else {
            return redirect()->route('freelancer.home'); // Redirect to freelancer home
        }
    }

    // Show client dashboard or freelancer home based on user role
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role;

            if ($role === 'client') {
                // Redirect to client dashboard
                return view('dashboard', compact('role'));
            } else {
                // Redirect to freelancer dashboard
                return view('freelance.home', compact('role'));
            }
        }

        // Redirect to login if user is not authenticated
        return redirect()->route('login');
    }

    // Fetch and display teams, both active and archived
    public function teamIndex()
    {
        // Fetch active teams
        $teams = Team::where('archived', false)->get();

        // Fetch archived teams
        $archivedTeams = Team::where('archived', true)->get();

        return view('teams.show-archive', [
            'teams' => $teams,
            'archivedTeams' => $archivedTeams,
        ]);
    }

    // Recover an archived team
    public function recoverTeam($id)
    {
        $team = Team::findOrFail($id);
        $team->archived = false;
        $team->save();

        return redirect()->route('teams.index')->with('status', 'Team recovered successfully!');
    }
}
