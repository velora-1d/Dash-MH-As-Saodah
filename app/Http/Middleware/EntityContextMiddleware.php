<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntityContextMiddleware
{
    /**
     * Handle an incoming request.
     * Enforces that the user has a valid Entity & Unit scope context.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Entity ID dan Unit ID biasanya dilempar via Header saat transaksi API
        // untuk menetapkan context aktif session-nya.
        $entityId = $request->header('X-Entity-ID');
        $unitId = $request->header('X-Unit-ID');

        if (!$entityId) {
            return response()->json(['message' => 'Missing Entity Context (X-Entity-ID header is required).'], 403);
        }

        // Cek database apakah user benar-benar diizinkan mengakses Entity/Unit tsb
        // Melalui tabel user_scopes
        $scopeQuery = \App\Models\UserScope::where('user_id', $user->id)
                                          ->where('entity_id', $entityId);

        if ($unitId) {
            $scopeQuery->where('unit_id', $unitId);
        }

        $hasScope = $scopeQuery->exists();

        if (!$hasScope) {
            return response()->json(['message' => 'Forbidden. You do not have access to this Entity/Unit Context.'], 403);
        }

        return $next($request);
    }
}
