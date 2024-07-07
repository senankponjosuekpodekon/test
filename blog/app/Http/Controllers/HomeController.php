<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class HomeController extends Controller
{

    // public function __construct()
    // // {
    // //     $this->middleware('auth');
    // // }

    public function index()
    {
        return view('home.index');
    }

    public function updatePassword(Request $request)

    {
        $user = Auth::user();
        $validated = $request->validate ([
            'current_password' => [
                'required', 
                'string', 
                function (string $attribute, mixed $value, Closure $fail) use ($user) {
                if (! Hash::check($value, Auth::user()->password)) {
                    $fail("Le :attribute est erroné.");
                }
            },
        ],

            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('home')->withStatus('Mot de passe modifié');

    }
}
