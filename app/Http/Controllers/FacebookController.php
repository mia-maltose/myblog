<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FacebookController extends Controller
{

public function redirect()
{
    return Socialite::driver('facebook')->redirect();
}

public function callback()
{
    try {
            $facebook_user = Socialite::driver('facebook')->stateless()->user();

            $user = User::where('facebook_id', $facebook_user->id)->first();


            if($user){
                auth()->login($user);
                session()->regenerate();
                return redirect('/')->with('success', 'Welcome back '. auth()->user()->username . '!');
            }else{
                $newUser = User::updateOrCreate([
                    'username' => $facebook_user->name,
                    'email' => $facebook_user->email,
                    'facebook_id'=> $facebook_user->id,
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
