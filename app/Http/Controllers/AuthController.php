<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registrationPage()
    {
        return view('auth.register');
    }

    public function register(Request $req)
    {
        $this->validate($req, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
        ]);

        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);

        Auth::attempt(['email' => $req->email, 'password' => $req->password]);

        return redirect()->route('posts')->with('success', 'Register successfully!');
    }

    public function loginPage()
    {
        # code...
        return view('auth.login');
    }

    public function login(Request $req)
    {
        $this->validate($req, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (!Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            return back()->with('error', 'Invalid login details');
        }
        return redirect()->route('home')->with('success', 'Welcome ' . $req->email);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('posts')->with('success', 'Logged out successfully!');
    }
}
