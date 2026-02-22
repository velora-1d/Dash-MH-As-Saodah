<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Check if user has required role within the active context.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $entityId = $request->header('X-Entity-ID');
        $unitId = $request->header('X-Unit-ID');

        // Cari Role terkait context saat ini
        $scopeQuery = \App\Models\UserScope::where('user_id', $user->id)
            ->where('entity_id', $entityId);

        if ($unitId) {
            $scopeQuery->where('unit_id', $unitId);
        }

        // Ambil scope untuk diperiksa role-nya
        $scope = $scopeQuery->first();

        if (!$scope) {
             return response()->json(['message' => 'Forbidden. Scope Context invalid.'], 403);
        }

        // Super Admin selalu memiliki akses (override)
        if ($scope->role === 'super_admin') {
            return $next($request);
        }

        // Cek jika role user dari scope ini ada di dalam list yang diizinkan (parameter ...$roles)
        if (!empty($roles) && !in_array($scope->role, $roles)) {
            return response()->json(['message' => "Forbidden. You don't have the required role ({$scope->role}) to access this resource."], 403);
        }

        return $next($request);
    }
}
