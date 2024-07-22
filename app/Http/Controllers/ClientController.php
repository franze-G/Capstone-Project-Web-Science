<?php

namespace App\Http\Controllers;

use App\Actions\Jetstream\DeleteUser;
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
        // Use the session to fetch the user_type

        return view('auth.register', compact('userType')); // Pass userType to the view
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

        // Redirect based on account type.
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
            $team = $user->currentTeam; // Get the current team if available

            // Return view based on the user's role
            if ($role === 'client') {
                // For clients (owners), display the default dashboard
                return view('dashboard', [
                    'role' => $role,
                    'team' => $team
                ]);
            } elseif ($role === 'freelancer') {
                // For freelancers (members), display the freelancer dashboard
                return view('freelance.home', [
                    'role' => $role,
                    'team' => $team // Pass the team if needed in the freelancer view
                ]);
            }
        }

        // Redirect to login if user is not authenticated
        return redirect()->route('login');
    }

    public function freelancerTasks()
    {
        $user = Auth::user();
        return view('freelance.tasks', [
            'user' => $user,
        ]);
    }

    public function freelancerTeams()
        $user = Auth::user();
        $role = $user->role;
        $team = $user->currentTeam;
        return view('freelance.teams', [
            'role' => $role,
            'team' => $team,
        ]);
    }


    // Fetch and display teams, both active and archived, owned by the currently logged-in user
    public function teamIndex()
    {
        $user = Auth::user();

        // Fetch active teams owned by the user
        $teams = Team::where([
            ['archived', false],
            ['user_id', $user->id],
            ['user_firstname', $user->firstname],
            ['user_lastname', $user->lastname],
        ])->get();

        // Fetch archived teams owned by the user
        $archivedTeams = Team::where([
            ['archived', true],
            ['user_id', $user->id],
            ['user_firstname', $user->firstname],
            ['user_lastname', $user->lastname],
        ])->get();

        return view('teams.show-archive', [
            'teams' => $teams,
            'archivedTeams' => $archivedTeams,
        ]);
    }

    // Recover an archived team
    public function recoverTeam($id)
    {
        $team = Team::findOrFail($id);

        // Ensure the team belongs to the currently logged-in user before recovering
        $user = Auth::user();
        if ($team->user_id !== $user->id || $team->user_firstname !== $user->firstname || $team->user_lastname !== $user->lastname) {
            return redirect()->route('teams.index')->with('error', 'You do not have permission to recover this team.');
        }

        $team->archived = false; // Update the team's archived status to false
        $team->save();

        return redirect()->route('teams.index')->with('status', 'Team recovered successfully!');
    }

    protected DeleteUser $deleteUser;

    /**
     * Create a new controller instance.
     *
     * @param \App\Actions\Jetstream\DeleteUser $deleteUser
     * @return void
     */
    public function __construct(DeleteUser $deleteUser)
    {
        $this->deleteUser = $deleteUser;
    }
 /**
     * Remove the specified user from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $userId)
    {
        $user = User::findOrFail($userId);

        // Call the delete method from DeleteUser
        $this->deleteUser->delete($user);

        return response()->json(['message' => 'User deleted successfully']);
    }
}
