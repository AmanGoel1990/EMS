<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SignupController extends Controller
{
    function index() {
        return view('signup');
    }

    function signup(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('login')->with('success', 'User added successfully!');
    }
}
