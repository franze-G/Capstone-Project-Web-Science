<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    //

    public function index() 
    {
        if(Auth::user()->role == 'client')
        {
            return view('dashboard');
        }

        else
        {
            return view('freelance.home');
        }

    }
}
