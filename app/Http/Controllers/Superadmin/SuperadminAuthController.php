<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Superadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperadminAuthController extends Controller
{
    // ================================
    // 🔐 Show Login Form
    // ================================
    public function showLogin()
    {
        return view('superadmin.login');
    }

    // ================================
    // ✅ Handle Login
    // ================================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('superadmin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('superadmin.dashboard');
        }

        return back()->withErrors(['Invalid credentials']);
    }

    // ================================
    // 🔓 Logout
    // ================================
    public function logout()
    {
        Auth::guard('superadmin')->logout();
        return redirect()->route('superadmin.login')->with('success', 'Logged out successfully');
    }

    // ================================
    // 🔑 Show Forgot Password Form
    // ================================
    public function showLinkRequestForm()
    {
        return view('superadmin.forgot');
    }

    // ================================
    // 📧 Send Reset Link
    // ================================
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('superadmins')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // ================================
    // 🔁 Show Reset Password Form
    // ================================
    public function showResetForm($token)
    {
        $email = request()->query('email');
        return view('superadmin.reset', compact('token', 'email'));
    }

    // ================================
    // 🔁 Handle Reset Password
    // ================================
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::broker('superadmins')->reset(
            $request->only('email', 'password', 'token'),
            function ($superadmin, $password) {
                $superadmin->password = Hash::make($password);
                $superadmin->setRememberToken(Str::random(60));
                $superadmin->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('superadmin.login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    // ================================
    // 👤 Show Register Form (Optional)
    // ================================
    public function registerForm()
    {
        return view('superadmin.auth.register');
    }

    // ================================
    // ➕ Register New Superadmin
    // ================================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:superadmins',
            'password' => 'required|min:6|confirmed',
        ]);

        Superadmin::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('superadmin.login')->with('success', 'Superadmin registered successfully.');
    }

    // ================================
    // 🏠 Dashboard
    // ================================
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }
}
