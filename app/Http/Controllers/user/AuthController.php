<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // public function login()
    // {
    //     return view('user.pages.auth.login');
    // }

    // public function signin(Request $request)
    // {
    //     return $request;
    //     $request->validate([
    //         'email' => 'required|exists:users,email',
    //         'password' => 'required'
    //     ], [
    //         'email.exists' => 'Invalid email address'
    //     ]);

    //     $user = User::where('email', $request->email)->first();
    //     if(Hash::check($request->password, $user->password)){
    //         return redirect()->back()->with('error', 'Email or Password is invalid')->withInput($request->all());
    //     }

    //     if ($user->hasRole('user')) {
    //         Auth::login($user);
    //         return redirect()->route('user.dashboard')->with('success', 'Login SuccessFully');
    //     }
    // }
}
