<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signInPage(){
        return view('./auth.signin');
    }

    public function signUpPage(){
        return view('./auth.signup');
    }

    //Sign In and Sign Up
    public function signUpUser(Request $request){
        $request->validate([
            'name'=> ['required', 'min:3', 'max:40', 'string'],
            'email'=> ['required', 'string', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'],
            'phone_number'=> ['required', 'string', 'regex:/^08[0-9]{8,13}$/'],
            'password' => ['required', 'min:6', 'max:12', 'string']

        ],['phone_number.regex' => 'Nomor telepon harus dimulai dengan "08" dan berisi 10-15 digit angka.',
        'email.regex' => 'Email harus menggunakan domain "@gmail.com".',
        ]);

        $role = ($request->email == 'admin@gmail.com') ? 'admin' : 'user';

        User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'role' => $role,
        ]);

        return redirect()->route('signin.page')->with('success', 'Registration Success!');
    }

    public function signInUser(Request $request){
        $request->validate([
            'email'=> ['required', 'string', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'],
            'password' => ['required', 'min:6', 'max:12', 'string']
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->regenerate();
            $user = Auth::user();

            return $user->role === 'admin'
                ? redirect()->route('admin.dashboard')->with('success', 'Log In Admin Berhasil!')
                : redirect()->route('user.dashboard')->with('success', 'Log In User Berhasil!');
        }

        return redirect()->route('signin.page')->with('error', 'Login Invalid!');
    }


    //Sign Out
    public function signOutUser(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('view');
    }
}
