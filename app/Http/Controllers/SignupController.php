<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    function index() {
        return view('signup');
    }

    function signup(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|string',
        ]);
        User::create($validatedData);

        return redirect()->route('login')->with('success', 'User added successfully!');
    }
}
