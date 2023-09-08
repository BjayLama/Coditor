<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credntials = $request->only('email','password');

        if (Auth:: attempt($credntials)) {
            return redirect()->intended('home');
        }

        return redirect('login')->with('error', 'Opps! Envalid Credentials');
    }

    public function logout() {
        Auth::logout();

        return redirect('login');
    }

    public function home() {
        return view('home');
    }
}
