<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class  ClientAuthController extends Controller
{

    public function showProfile()
    {
        return view('client.profile.show', [
            'user' => Auth::guard('client')->user(),
        ]);
    }

    // for showing interface ng clients registration form

    public function showRegistrationForm()
    {
        return view('Client.auth.register');
    }

    // for client registration. which is nagana pero di nag reredirect sa dashboard. 

    public function Register(Request $request)
    {

        $request->validate([

            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $client = Client::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('client')->login($client);

        return redirect()->route('client.dashboard');

    }

    // for function ng login which is indicated sa action route ng login.blade.php under ng Client folder.

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('client')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('client.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('client.login');
    }

    public function dashboard()
    {
        return view('Client.dashboard');
    }


    public function showLoginForm()
    {
        return view('Client.auth.login');
    }

}



