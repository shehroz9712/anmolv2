<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }

    public function changePassword(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // $user = Auth::user();
        $user =  User::where('id', Auth::User()->id)->first();
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return back()->with('message', 'Password changed successfully.');
        } else {
            return back()->with('error', 'Old Password doesn\'nt match.');
        }
    }
}
