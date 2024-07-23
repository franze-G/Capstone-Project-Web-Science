<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class FreelanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tasks = [];

        if ($user->currentTeam) {
            // If the user is part of a team, fetch tasks assigned to the user and tasks created by the user
            $tasks = Project::where(function ($query) use ($user) {
                $query->where('assigned_id', $user->id)
                      ->orWhere('created_by', $user->id);
            })->get();
        } else {
            // If the user is not part of a team, fetch tasks created by the user
            $tasks = Project::where('created_by', $user->id)->get();
        }

        return view('freelance.projects', compact('tasks'));
    }

    public function startTask($id)
    {
        $task = Project::findOrFail($id);
        $task->status = 'in-progress';
        $task->save();

        return redirect()->back()->with('success', 'Task status updated to "In-Progress".');
    }

    public function completeTask($id)
    {
        $task = Project::findOrFail($id);
        $task->status = 'completed';
        $task->save();

        return redirect()->back()->with('success', 'Task status updated to "Completed".');
    }

    public function getTaskDetails($id)
{
    $task = Project::findOrFail($id);

    return response()->json([
        'title' => $task->title,
        'description' => $task->description,
        'due_date' => $task->due_date,
        'priority' => $task->priority,
        'service_fee' => $task->service_fee,
        'assigned_firstname' => $task->assigned_firstname,
        'assigned_lastname' => $task->assigned_lastname,
        'status' => $task->status,
    ]);
}
}
