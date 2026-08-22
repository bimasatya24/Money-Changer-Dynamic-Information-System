<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // =========================
    // LOGIN ADMIN
    // =========================
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'name';

        if (Auth::attempt([
            $loginType => $request->username,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'login_error' => 'Username atau Password salah.',
        ]);
    }

    // =========================
    // REGISTRASI PELANGGAN
    // =========================
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $validated['name'],
            'password' => $validated['password'],
        ]);

        return redirect()
            ->route('customer.login')
            ->with('success', 'Akun berhasil dibuat. Silakan masuk.');
    }

    // =========================
    // LOGIN PELANGGAN
    // =========================
    public function customerLogin(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/pesan-antar');
        }

        return back()->withErrors([
            'login_error' => 'Nama atau Password salah.',
        ])->onlyInput('name');
    }

    // =========================
    // LOGOUT PELANGGAN
    // =========================
    public function customerLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pesan-antar');
    }
}
