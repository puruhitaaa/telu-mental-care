<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------|
    | REGISTER
    |--------------------------------------------------------------------------|
    */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'age'        => 'required|integer|min:15|max:60',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|confirmed|min:6',
            'phone'      => 'required|string',
            'role'       => 'required|in:student,counselor',
        ]);

        // ✅ SIMPAN ROLE & DATA TAMBAHAN
        $user = User::create([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        Auth::login($user);

        // ✅ REDIRECT SESUAI ROLE
        if ($user->role === 'counselor') {
            return redirect()->route('counselor.dashboard');
        }

        return redirect()->route('student.dashboard');
    }

    /*
    |--------------------------------------------------------------------------|
    | LOGIN
    |--------------------------------------------------------------------------|
    */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ✅ REDIRECT SESUAI ROLE
            if (auth()->user()->role === 'counselor') {
                return redirect()->route('counselor.dashboard');
            }

            return redirect()->route('student.dashboard');
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------|
    | LOGOUT
    |--------------------------------------------------------------------------|
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
