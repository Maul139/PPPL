<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRoleLogin($role)
    {
        return view('auth.loginrole', compact('role'));
    }

    public function showRoleRegister($role)
    {
        return view('auth.registerrole', compact('role'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'mahasiswa') {
                return redirect()->route('kesehatan.index');
            } elseif ($user->role === 'ahli_gizi') {
                return redirect()->intended('/gizi/dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan salah.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:mahasiswa,ahli_gizi,admin',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        Auth::login($user);

        if ($user->role === 'mahasiswa') {
            return redirect()->route('biodata.create');
        }

        return redirect()->intended('/gizi/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
