<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $userName = Auth::freelance_user_table()->firstname;
        $position = Auth::freelance_user_table()->position;
        return view('dashboard', ['userName' => $userName, 'position' => $position]);
    }
}
