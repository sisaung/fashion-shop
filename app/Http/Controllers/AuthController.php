<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function showLogin() {

        return view('auth.login');
    }

    public function setNextAndLogin(Request $request)
{

    // Store next page in session

    session(['next_action_after_login' => $request->input('next')]);


    // Redirect to login page
    return redirect()->route('login');
}


    public function login(LoginRequest $request) {

        if(Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            if($request->user()->is_admin === 'admin') {

                return redirect('/dashboard')->with('success','Login successfully');
            }

            UserReviewController::attachGuestReviewsToUser(Auth::id());


            // Redirect to next page if provided
            $next = session()->pull('next_action_after_login', '/');
            return redirect()->to($next);
        }

        // return back()->withErrors([
        //     'authError' => 'The provided credentials do not match our records.',
        // ]);
        return back()->with('error', 'Invalid Credentials');
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

        return redirect('/')->with('success','Logout successfully');


    }

    public function redirectToGoogle(Request $request) {

        if ($request->has('next')) {
            session(['next_action_after_login' => $request->query('next')]);
        }
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        $user =  Socialite::driver('google')->user();


        $finduser = User::where('email', $user->email)->first();

        if(!is_null($finduser)) {

            Auth::login($finduser);


    }else{

            $finduser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make('asdffdsa'),
                'google_id' => $user->id,
                'profile_image' => $user->avatar,
            ]);

            Auth::login($finduser);

        }

        // $attached = UserReviewController::attachGuestReviewsToUser(Auth::id());
        // dd($attached);

        $next = session()->pull('next_action_after_login', '/');
        return redirect()->to($next);


    }


}


