<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class GuestController extends Controller
{
    public function index()
    {
        // Generate and store a unique guest identifier in the session
        $user = new User([
            
        ]);
        $user = User::create([
            'name' => "Guest".random_int(10, 9999),
            'email' => Uuid::uuid4()->toString(),
            'Role' => "Guest",
            'password' => Hash::make('guest_user'),
        ]);

        Auth::login($user);

        session()->regenerate();
        return redirect('/'); 
        // return view('Dashboard.pages.home');

        // return view('Dashboard.pages.home');
    }
    public function GuestLogout(){
            if (Auth::check()) {
            }
            $user = User::where('id','=',Auth::user()->id
            )->firstOrFail();;
    
            // Delete the user's account
            $user->delete();
    
            // Log out the user
            Auth::logout();
        
            return redirect('/'); // Redirect to the desired page after logout
        
    }

    public function Convert2User(Request $request)
    {
        // Validate the user's registration data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Create a new user
        // $user =  new User([
        //     'name' => $request->input('name'),
        //     'email' => $request->input('email'),
        //     'phone' => $request->input('phone'),
        //     'Role' => 'User',
        //     'password' => Hash::make($request->password),
        // ]);
        $user = User::where('id',Auth::user()->id)->first();
        
        $user->update([
            'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'Role' => 'User',
                'password' => Hash::make($request->password)
        ]);
            

        Auth::logout();

         return redirect('/');
    }
}
