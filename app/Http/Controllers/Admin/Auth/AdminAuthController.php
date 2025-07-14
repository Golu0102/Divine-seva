<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['Invalid credentials']);
    }


    public function logout()
    {
        Auth::guard('admin')->logout(); // ✅ logs out admin guard
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }

    // ================================
    // 🔑 Show Forgot Password Form
    // ================================
    public function forgotForm()
    {
        return view('admin.forgot');
    }

    // ================================
    // 📧 Send Reset Link
    // ================================
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('admins')->sendResetLink(
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
        return view('admin.reset', compact('token', 'email'));
    }

    // ================================
    // 🔁 Handle Reset Password
    // ================================
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'token'),
            function ($admin, $password) {
                $admin->password = Hash::make($password);
                $admin->setRememberToken(Str::random(60));
                $admin->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    // ================================
    // 👤 Show Admin Register Form
    // ================================
    public function registerForm()
    {
        return view('admin.auth.register');
    }

    // ================================
    // ➕ Register New Admin
    // ================================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin registered successfully.');
    }
}
