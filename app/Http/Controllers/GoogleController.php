<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleController extends Controller
{

public function redirect()
{
    return Socialite::driver('google')->redirect();
}

public function callback()
{
    try {
            $google_user = Socialite::driver('google')->stateless()->user();

            $user = User::where('google_id', $google_user->id)->first();


            if($user){
                auth()->login($user);
                session()->regenerate();
                return redirect('/')->with('success', 'Welcome back '. auth()->user()->username . '!');
            }else{
                $newUser = User::updateOrCreate([
                    'username' => $google_user->name,
                    'email' => $google_user->email,
                    'google_id'=> $google_user->id,
                ]);

                auth()->login($newUser);
                session()->regenerate();
                return redirect('/')->with('success', 'Account created.');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
   }
}
