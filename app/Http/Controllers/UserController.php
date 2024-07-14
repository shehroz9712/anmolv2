<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $users = User::with('event')->get();
        return view('Admin.user.index', compact('users'));
    }
    public function show($id)
    {

        $id = decrypt($id);

        $user = User::where('id', $id)->with('event')->first();
        return view('Admin.user.view', compact('user'));
    }
}
