<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'motdepasse' => 'required|string',
        ]);
    
        $user = \App\Models\User::where('login', $request->login)->first();
    
        if (!$user || !\Illuminate\Support\Facades\Hash::check($request->motdepasse, $user->motdepasse)) {
            return back()->withErrors([
                'login' => 'Identifiants incorrects',
            ])->withInput();
        }
    
        \Illuminate\Support\Facades\Auth::login($user, $request->remember);
    
        return redirect()->intended(
            $user->isAdmin() ? route('admin.dashboard') : route('user.dashboard')
        );
    }
    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
