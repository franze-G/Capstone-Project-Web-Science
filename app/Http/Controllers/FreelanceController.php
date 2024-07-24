<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelanceController extends Controller
{
    public function freelancerTasks()
    {
        $user = Auth::user();
        return view('freelance.tasks', [
            'user' => $user,
        ]);
    }
}
