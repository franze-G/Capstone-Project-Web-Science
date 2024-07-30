<?php

namespace App\Http\Controllers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\Team;
use App\Models\User;
use App\Models\Project; // Add this import for Project model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator; // Import Validator for use in saveRating method

class ClientController extends Controller
{
    // Show registration form with optional role pre-filled
    public function showRegistrationForm(Request $request)
    {
        // Fetch role from query parameters or session
        $userType = $request->query('role') ?? session('user_type');

        // Return registration view with the role parameter
        return view('auth.register', compact('userType'));
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate the registration data
        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\-]+$/'], 
            'lastname' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\-]+$/'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'confirmed', 'min:8', 'regex:/[A-Z]/'],
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
    
        // Redirect based on the user's role
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

            // Get task counts
            $taskCounts = $this->getTaskCounts($user);

            // Return view based on the user's role
            if ($role === 'client') {
                // For clients (owners), display the default dashboard
                return view('dashboard', [
                    'role' => $role,
                    'team' => $team,
                    'pendingCount' => $taskCounts['pending'],
                    'inProgressCount' => $taskCounts['inProgress'],
                    'completedCount' => $taskCounts['completed'],
                ]);
            } elseif ($role === 'freelancer') {
                // For freelancers (members), display the freelancer dashboard
                return view('freelance.home', [
                    'role' => $role,
                    'team' => $team,
                    'pendingCount' => $taskCounts['pending'],
                    'inProgressCount' => $taskCounts['inProgress'],
                    'completedCount' => $taskCounts['completed'],
                ]);
            }
        }

        // Redirect to login if user is not authenticated
        return redirect()->route('login');
    }

    // Method to get task counts
    protected function getTaskCounts($user)
    {
        // Initialize task counts
        $pendingCount = 0;
        $inProgressCount = 0;
        $completedCount = 0;

        // Initialize tasks collection as empty if null
        $tasks = collect();

        if ($user->currentTeam) {
            // If the user is part of a team, fetch tasks assigned to the user and tasks created by the user
            $tasks = Project::where('created_by', $user->id)
                             ->orWhere('assigned_id', $user->id)
                             ->get();
        } else {
            // If the user is not part of a team, fetch tasks created by the user
            $tasks = Project::where('created_by', $user->id)->get();
        }

        // Count tasks by status
        $pendingCount = $tasks->where('status', 'pending')->count();
        $inProgressCount = $tasks->where('status', 'in-progress')->count();
        $completedCount = $tasks->where('status', 'completed')->count();

        return [
            'pending' => $pendingCount,
            'inProgress' => $inProgressCount,
            'completed' => $completedCount
        ];
    }

    public function freelancerTasks()
    {
        $user = Auth::user();
        return view('freelance.tasks', [
            'user' => $user,
        ]);
    }

    public function freelancerTeams()
    {
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

    public function activityView()
    {
        // Ensure the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            
            // Fetch completed tasks assigned by the currently logged-in client
            $completedTasks = Project::where('created_by', $user->id)
                                    ->where('status', 'completed')
                                    ->get();

            // Return the view with the completed tasks
            return view('client.activity', [
                'completedTasks' => $completedTasks
            ]);
        }

        // Redirect to login if user is not authenticated
        return redirect()->route('login');
    }

    public function rateUser(Request $request, $userId)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false, 
                'message' => 'Invalid rating'
            ], 400);
        }
    
        $user = User::find($userId);
    
        if (!$user) {
            return response()->json([
                'success' => false, 
                'message' => 'User not found'
            ], 404);
        }
    
        // Update the user's star rating
        $user->star_rating = $request->input('rating');
        $user->save();
    
        return response()->json([
            'success' => true, 
            'message' => 'Rating submitted successfully'
        ]);
    }

    public function getUserRating($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'rating' => $user->star_rating
            ]);
        }

        return response()->json([
            'rating' => null
        ]);
    }
}
