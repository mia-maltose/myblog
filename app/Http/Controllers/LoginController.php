<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create(){
        return view('login.create');
    }

    public function store(Request $request)
    {
        $request = $request->validate([
            'email' => ['required','email'],
            'password'=> ['required'],
        ]);

        if(auth()->attempt($request)){
            session()->regenerate();

            return redirect("/")->with('success', 'Welcome back '. auth()->user()->username . '!');
        }
        throw ValidationException::withMessages(['password'=>'User not found. Please provide the correct email address and password.']);
    }
}
