<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        \Log::info('User Roles: ' . implode(', ', $user->roles()->pluck('name')->toArray()));
        if ($user && $user->roles()->where('name', 'ROLE_ADMIN')->exists()) {
            return $next($request);
        }

        // Log unauthorized attempts for debugging
        \Log::warning('Unauthorized access attempt: ' . $request->url());

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
