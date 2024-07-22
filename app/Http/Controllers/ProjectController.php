<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Save a newly created project in storage.
     */
    public function save(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'service_fee' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'priority' => 'required|string|in:low,high',
            'assigned_id' => 'required|exists:users,id', // Validate assigned_id
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate images
        ]);

        // Fetch assigned user details
        $assignedUser = User::find($validated['assigned_id']);
        $assignedFirstname = $assignedUser ? $assignedUser->firstname : null;


        // Create a new project instance and save it to the database
        $project = new Project();
        $project->title = $validated['title'];
        $project->description = $validated['description'];
        $project->service_fee = $validated['service_fee'];
        $project->priority = $validated['priority'];
        $project->due_date = $validated['due_date'];
        $project->created_by = Auth::id();
        $project->user_firstname = auth()->user()->firstname;
        $project->user_lastname = auth()->user()->lastname;
        $project->assigned_id = $validated['assigned_id'];
        $project->assigned_firstname = $assignedFirstname;

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('images', 'public');
            }
        }

        $project->image_path = json_encode($imagePaths); // Save image paths as JSON

        $project->save();

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Project assigned successfully.');
    }
}
