<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Cek apakah user memiliki role yang diizinkan.
     * Support web (redirect) dan API (JSON response).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('login');
        }

        // Superadmin, kepsek, dan bendahara selalu memiliki akses penuh
        if (in_array($user->role, ['superadmin', 'kepsek', 'bendahara'])) {
            return $next($request);
        }

        // Cek apakah role user termasuk dalam daftar role yang diizinkan
        if (!empty($roles) && !in_array($user->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => "Akses ditolak. Role '{$user->role}' tidak memiliki izin untuk mengakses halaman ini."
                ], 403);
            }

            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
