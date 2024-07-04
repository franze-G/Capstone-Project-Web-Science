<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){

        return view('Client.Teams');
    }

    public function AddTask(Request $request)
    {
        $request->validate([

            'Title' => ['required', 'string', 'max:100' ],
            'Description' => ['required', 'string', 'max:1000'],
            'due_date' => ['required', 'date',],
            'rate' => ['required', 'min:300'],
            'image' => ['required', 'array', 'max:3'],
            'image.*' => ['required', 'mimes:jpg,png', 'max:2048'], //mimes yung required fils, then yung 2mb maximum per image.
        ]);
    }
}
