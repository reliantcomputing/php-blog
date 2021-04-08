<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

        return redirect()->route('posts');
    }
}
