<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user()->role);
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            return response()->json([
                'success' => true,
                'redirect' => $this->getRedirectPath($user->role)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username/Nomor Induk atau password salah.'
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function redirectBasedOnRole($role)
    {
        return redirect($this->getRedirectPath($role));
    }

    private function getRedirectPath($role)
    {
        if ($role === 'super_admin') {
            return '/super-admin/dashboard';
        } elseif ($role === 'pengajar') {
            return '/pengajar/dashboard';
        }
        return '/santri/dashboard';
    }
}
