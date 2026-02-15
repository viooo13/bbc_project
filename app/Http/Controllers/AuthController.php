<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Try to find user by email or name (username)
        $user = \App\Models\User::where('email', $credentials['username'])
                    ->orWhere('name', $credentials['username'])
                    ->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password tidak sesuai.',
        ]);
    }

    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'agree' => 'required',
        ]);

        // Create user here
        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => 'user',
            'password' => bcrypt($validated['password']),
        ]);

        Auth::login($user);
        return redirect()->route('admin.dashboard');
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('showLogin');
    }

    // Handle universal login form (user or admin)
    public function universalLoginSubmit(Request $request)
    {
        $data = $request->validate([
            'role' => 'required|string',
            'email' => 'nullable|email',
            'username' => 'nullable|string',
            'password' => 'required|string',
        ]);
        // Role-based lookup and check
        $password = $data['password'];

        if ($data['role'] === 'admin') {
            $username = trim((string) $request->input('username'));
            $user = \App\Models\User::where(function ($q) use ($username) {
                $q->where('name', $username)
                  ->orWhere('email', $username);
            })->where('role', 'admin')->first();
        } else {
            $email = trim((string) $request->input('email'));
            $user = \App\Models\User::where('email', $email)->where('role', 'user')->first();
        }

        if ($user && (\Illuminate\Support\Facades\Hash::check($password, $user->password) || $user->password === $password)) {
            // If password was stored in plaintext (manual insertion), re-hash it now
            if ($user->password === $password) {
                $user->password = bcrypt($password);
                $user->save();
            }

            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }

        // Fallback: try to find user ignoring the provided role (handles mistaken hidden role)
        $identifier = trim((string) ($request->input('username') ?? $request->input('email')));
        if ($identifier) {
            $user2 = \App\Models\User::where('name', $identifier)
                        ->orWhere('email', $identifier)
                        ->first();

            if ($user2 && (\Illuminate\Support\Facades\Hash::check($password, $user2->password) || $user2->password === $password)) {
                if ($user2->password === $password) {
                    $user2->password = bcrypt($password);
                    $user2->save();
                }
                Auth::login($user2);
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->with('error', 'Username/email atau password tidak sesuai.');
    }
}
