<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Jika role user tidak ada dalam daftar role yang diizinkan
        if (!in_array($user->role, $roles)) {
            // Redirect sesuai role milik user
            if ($user->role === 'mahasiswa') {
                return redirect()->route('kesehatan.index');
            } elseif ($user->role === 'ahli_gizi') {
                return redirect()->route('gizi.dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect('/');
        }

        return $next($request);
    }
}
