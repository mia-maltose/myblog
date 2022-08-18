<?php

namespace App\Http\Controllers;

use App\Models\User;

class LogoutController extends Controller
{
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye~');
    }
}
