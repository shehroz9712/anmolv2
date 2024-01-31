<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;


class GoogleAuthController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver("google")->redirect();
    }
    protected $emailService;
   

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }
    public function sendWelcomeEmail($user)
{
    $subject = 'Welcome to Eat Anmol';

    $mailable = new WelcomeMail($user, 'Welcome to our Eat Anmol!');

    $this->emailService->sendEmail($user, $subject, $mailable);

    return;
}

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver("google")->user();
            $user = User::where("google_id", $google_user->getId())->first();
        $checkEmail = User::where('email',$google_user->getEmail())->first();
        
            if ($user == null && $checkEmail != null) {
                return redirect()->route('login')->with('error', 'Email Already Registered');
               
            }
            else if(!$user ){
                $new_user = User::create([
                    "name" => $google_user->getName(),
                    "email" => $google_user->getEmail(),
                    "google_id" => $google_user->getId(),
                ]);
                $this->sendWelcomeEmail($new_user);
                Auth::login($new_user);
                
        session()->regenerate();
                return redirect()->intended("home");
            }
            else {
                Auth::login($user);
                return redirect()->intended("home");
            }
        } catch (\Throwable $th) {
            // Log the error for debugging purposes.
            // dd($th);
            Log::error("Google OAuth error: " . $th->getMessage());
            // You can also flash an error message and redirect to a login page or home page.
            return redirect()->route('login')->with('error', 'Google OAuth login failed.');
        }
    }
    
}
