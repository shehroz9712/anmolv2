<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user(); // Get the authenticated user
        return view('Dashboard.pages.profile.profile_edit', compact('user'));
    }
     
    public function index(): View
    {
        $user = Auth::user(); // Get the authenticated user
        return view('Dashboard.pages.profile.profile_index', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
    
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            // Add other validation rules for other fields as needed
        ]);
        
        // $user->fill($request->validated());
        // $user =  User::where('id',$request->id)->first();
        $user = User::findOrFail($request->id);
        //  dd($user);
        if ($user->email != $request->email) {
            $existingUser = User::where('email', $user->email)->first();
            
            if ($existingUser && $existingUser->id !== $user->id) {
                // session(['error' => 'Email Already Exists']);
                return back()->with('error', 'Email Already Exists.');
            }
            
            $user->email_verified_at = null;
        }

            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->name = $request->name;
        
        // dd($user);
        
        $user->save();
        // session(['error' => 'Email Already Exists']);
        return redirect()->route('profile.index')->with('message', 'Profile Updated Successfully.');
    }
    
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
       try {
        $token = Auth::user()->token;
        $token->revoke();
       } catch (\Throwable $th) {
       }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
