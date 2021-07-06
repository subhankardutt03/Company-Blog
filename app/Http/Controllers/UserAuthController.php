<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'user has been Logged out Successfully');
    }
}