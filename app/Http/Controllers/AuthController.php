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
            Auth::guard('web')->login($user);
            return redirect()->route('home');
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

        Auth::guard('web')->login($user);
        return redirect()->route('home');
    }

    // Handle logout
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('showLogin');
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout(); // Also logout from web guard in case admin was User model
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

            // First try to find in Admin model
            $admin = \App\Models\Admin::where(function ($q) use ($username) {
                $q->where('username', $username)
                    ->orWhere('email', $username);
            })->first();

            // If not found in Admin model, check User model with admin role
            if (!$admin) {
                $admin = \App\Models\User::where(function ($q) use ($username) {
                    $q->where('name', $username)
                        ->orWhere('email', $username);
                })->where('role', 'admin')->first();

                // If still not found, create the admin account
                if (!$admin && $username === 'bbcjaya123') {
                    $admin = \App\Models\User::create([
                        'name' => 'bbcjaya123',
                        'email' => 'admin@bbc.com',
                        'phone' => '08123456789',
                        'password' => bcrypt('bbcjaya123'),
                        'role' => 'admin',
                    ]);
                }
            }
        } else {
            $email = trim((string) $request->input('email'));
            $user = \App\Models\User::where('email', $email)->where('role', 'user')->first();
        }

        if ($data['role'] === 'admin') {
            if (!$admin || !\Illuminate\Support\Facades\Hash::check($password, $admin->password)) {
                return back()->with('error', 'Username/email atau password tidak sesuai.');
            }

            // Check status only for Admin model instances
            if (get_class($admin) === \App\Models\Admin::class && ($admin->status ?? 'active') !== 'active') {
                return back()->with('error', 'Akun admin sedang nonaktif.');
            }

            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        if ($user && (\Illuminate\Support\Facades\Hash::check($password, $user->password) || $user->password === $password)) {
            // If password was stored in plaintext (manual insertion), re-hash it now
            if ($user->password === $password) {
                $user->password = bcrypt($password);
                $user->save();
            }

            Auth::guard('web')->login($user);
            return redirect()->route('home');
        }

        return back()->with('error', 'Username/email atau password tidak sesuai.');
    }
}
