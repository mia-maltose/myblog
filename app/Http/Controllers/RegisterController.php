<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(Request $request){
        $request=$request->validate([
            'username' => ['required','max:20','min:2', Rule::unique('users','username')],
            'email' => ['required','email', 'max:50', Rule::unique('users','email')],
            'password'=> ['required','max:50','min:6'],
        ]);

        $request['password'] = bcrypt($request['password']);

        $user = User::create($request);

        auth()->login($user);
        session()->regenerate();

        return redirect('/')->with('success', 'Account created.');
    }
}
