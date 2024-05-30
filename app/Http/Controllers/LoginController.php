<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginController extends Controller
{
    public function authenticate(Request $request) 
    {
        $password = $request->input('password');
        $email    = $request->input('email');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    public function showLoginForm() 
    {
        return view('auth.login');
    }

    public function showRegisterForm() 
    {
        return view('auth.register');
    }

    public function register(Request $request) {
        $password = $request->input('password');
        $confirm  = $request->input('confirm');
        $email    = $request->input('email');
        $name     = $request->input('name');

        if ($password !== $confirm) {
            return back()->withErrors([
                'password' => 'The provided passwords must match',
            ]);
        }

        User::updateOrCreate(
            ['email' => $email, 'name' => $name],
            ['password' => Hash::make($password)]
        );

        return redirect()->route('home');
    }

}
