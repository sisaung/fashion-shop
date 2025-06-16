<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin() {

        return view('auth.login');
    }

    public function login(LoginRequest $request) {

        if(Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            if($request->user()->is_admin === 'admin') {

                return redirect('/dashboard');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(RegisterRequest $request) {


      $user =   User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $request->session()->regenerate();

        return redirect()->route('login');

    }

    public function logout(Request $request) {


        Auth::login($request->user());
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');


    }
}


