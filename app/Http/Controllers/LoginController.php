<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Loginuser;

class LoginController extends Controller
{
    function index() {
        return view('login');
    }

    public function login(Request $request) {
        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        // $user = User::where('email', $request->email)->where('password', $request->password)->first();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            if(Auth::user()->role === 'speaker') {
                return redirect()->route('proposal')->with('success', 'Login successful!');
            } else {
            return redirect()->route('dashboard')->with('success', 'Login successful!');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
