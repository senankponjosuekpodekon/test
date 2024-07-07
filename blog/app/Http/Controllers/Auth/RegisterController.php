<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller

{

    //  public function __construct()
    //  {
    
    //      $this->middleware('guest');
    //  }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'between:5,255'],
            'email' => ['required', 'email','regex:/(.*)@gmail\.com/i', 'unique:users' ],
            'phone' => ['required', 'string', 'min:8', 'max:15', 'unique:users' ],
            'password' => ['required', 'string' , 'min:8'  , 'confirmed'],


        ]);

        $validated['password'] = Hash::make($validated['password']);


        //un dd pour faire un var_dump et un die derrière 

        $user = User::create($validated);


        Auth::login($user);

        return redirect()->route('home')->withStatus('Inscription réussie !');
    }
}
