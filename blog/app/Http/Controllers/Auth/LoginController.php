<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth\AppServiceProvider;
use App\Http\Controllers\Auth\RedirectResponse;
// use App\Http\Controllers\Auth\LoginController();
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller

{

    // public function __construct(){
    //     $this->middleware('guest')->except('logout');
    // }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        
 
        if (Auth::attempt($credentials, (bool) $request->remember)) {
            $request->session()->regenerate();
 
            return redirect()->intended('home');
            // return redirect()->intended(AppServiceProvider::HOME);

        }
 
        return back()->withErrors([
            'email' => 'Les informations ne correspondent pas.',
        ])->onlyInput('email');
    }

            public function logout(Request $request)
        {
            Auth::logout();
        
            $request->session()->invalidate();
        
            $request->session()->regenerateToken();
        
            return redirect('/');
        }
}