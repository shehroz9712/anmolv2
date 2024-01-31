<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\EmailService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use WelcomeEmail;

class RegisteredUserController extends Controller
{
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

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // User already exists
            return back()->with('error', 'User with this email already exists.');
        }
        $request->validate([
            'phone' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'], // 'users' is the table name
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $this->sendWelcomeEmail($user);
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
