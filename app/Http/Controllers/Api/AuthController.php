<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $credentials['email'])->first();
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json(
                ['message' => 'Email atau password salah.'],
                401
            );
        }
        $token = $user->createToken('postman')->plainTextToken;
        return response()->json([
            'message' => 'Login berhasil.',
            'token' => $token,
            'user' => $user->only(['id', 'name', 'email', 'role']),
        ]);
    }
    
    public function me(Request $request)
    {
        return response()->json($request->user()->only([
            'id',
            'name',
            'email',
            'nim',
            'role'
        ]));
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout berhasil. Token sudah tidak berlaku.']);
    }
}
