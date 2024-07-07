<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(){

        return view('Client.Teams');
    }

    public function AddTask(Request $request)
    {
        Log::info('Request Data:', $request->all()); 

        $validated = $request->validate([

            'title' => 'required','string', 'max:100',
            'description' => 'string', 'max:1000',
            'rate' => 'required','min:300',
            'priority' => 'required', 'string', 'in:low,high',
            'due_date' => 'required', 'date',
            'image' => 'nullable', 'array', 'max:3',
            'image.*' => 'mimes:jpg,png', 'max:2048', //mimes yung required files, then yung 2mb maximum per image.
        ]);

        $task = new Task();
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->rate = $validated['rate'];
        $task->priority = $validated['priority'];
        $task->due_date = $validated['due_date'];

        if ($request->hasFile('image')) {
            $imagePaths = [];
            foreach ($request->file('image') as $image) {
                $path = $image->store('images', 'public');
                $imagePaths[] = $path;
            }
            $task->image_path = json_encode($imagePaths); // Store image paths as JSON in a single column
        }

            $task->save();

        return redirect()->back()->with('success', 'Task created successfully!');

    }
}
