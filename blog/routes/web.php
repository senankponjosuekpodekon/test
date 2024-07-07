<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// use App\Models\User;
// use Illuminate\Auth\Events\PasswordReset;
// use Illuminate\Support\Facades\Password;
// use Illuminate\Support\Str;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/logout', function () {
//     return view('logout');
// })->middleware('guest')->name('logout');


// Route::post('/reset-password', function (Request $request) {
//     $request->validate([
//         'token' => 'required',
//         'email' => 'required|email',
//         'password' => 'required|min:8|confirmed',
//     ]);
 
//     $status = Password::reset(
//         $request->only('email', 'password', 'password_confirmation', 'token'),
//         function (User $user, string $password) {
//             $user->forceFill([
//                 'password' => Hash::make($password)
//             ])->setRememberToken(Str::random(60));
 
//             $user->save();
 
//             event(new PasswordReset($user));
//         }
//     );
 
//     return $status === Password::PASSWORD_RESET
//                 ? redirect()->route('login')->with('status', __($status))
//                 : back()->withErrors(['email' => [__($status)]]);

// })->middleware('guest')->name('password.update');



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::patch('/home', [HomeController::class, 'updatePassword']);

Route::resource('/admin/posts', AdminController::class)->except('show')->names('admin.posts');



Route::get('/',[PostController::class,'index'])->name('index');
Route::get('/categories/{category}', [PostController::class,'postsByCategory'])->name('post.bycategory');
Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');

Route::post('/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');





// Route::post('/register', [RegisterController::class, 'register']);

// Route::get('/home', [HomeController::class, 'index'])->name('index');

// Route::get('/categories/{category}', [PostController::class, 'PostsByCategory'])->name('posts.byCategory');
