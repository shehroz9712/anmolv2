<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */ 
    public function store(LoginRequest $request): RedirectResponse
    {
       
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function adminLogin(LoginRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->email)->first();
        //  dd($user);
        if($user && $user->Role !== 'Admin'){
         
            return  redirect()->back()->with('message','user not found');
        }
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function adminView()
    {
        return view('auth.admin-login');
    }

    public function kitchenLogin(LoginRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->email)->first();
        //  dd($user);
        if($user && $user->Role !== 'Kitchen'){
         
            return  redirect()->back()->with('message','user not found');
        }
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function kitchenView()
    {
        return view('auth.kitchen-login');
    }
   

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        try {
            $token = Auth::user()->token;
            $token->revoke();
           } catch (\Throwable $th) {
           }
        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/');
    }
}
