<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AppleAuthController extends Controller
{
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }
}

