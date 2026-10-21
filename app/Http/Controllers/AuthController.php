<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);
        // Auth::attempt mencocokkan email dan password
        // (yang sudah di-hash) di tabel users
        $ingat = $request->boolean('remember');
        if (Auth::attempt($credentials, $ingat)) {
            // buat sesi baru agar aman
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'nim' => 'required|max:20|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            // confirmed = harus sama dengan password_confirmation
            'password' => 'required|min:8|confirmed',
        ], [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah terdaftar.',
            'email' => 'Format email tidak valid.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ], [
            'name' => 'Nama',
            'nim' => 'NIM',
            'email' => 'Email',
            'password' => 'Password',
        ]);
        // Role ditentukan oleh server, BUKAN dari isian form
        $validated['role'] = 'mahasiswa';
        // Password otomatis di-hash karena Model User punya cast 'password' => 'hashed'
        $user = User::create($validated);
        Auth::login($user); // langsung login setelah daftar
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'Selamat datang, akun Anda berhasil dibuat.');
    }
}
