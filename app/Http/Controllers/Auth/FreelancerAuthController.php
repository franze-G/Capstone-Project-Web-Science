<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FreelancerAuthController extends Controller
{
    
    public function showRegistrationForm()
    {
        return view('Freelancer.auth.register');
    }

    // Registration 

    public function Register(Request $request)
    {

        $request->validate([

            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:freelancers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $freelancer = Freelancer::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('freelance')->login($freelancer);

        return redirect()->route('Freelancer.dashboard');

    }

    public function showLoginForm()
    {
        return view('Freelancer.auth.login');
    }

    // Login Function 

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        if (Auth::guard('freelancer')->attempt($request->only('email', 'password'))) {
            return redirect()->route('Freelancer.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout

    public function logout()
    {
        Auth::guard('freelancer')->logout();
        return redirect()->route('Freelancer.auth.login');
    }

}
