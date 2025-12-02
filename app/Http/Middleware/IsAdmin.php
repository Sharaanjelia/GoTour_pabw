<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // If not authenticated -> send to login page
        if (!$user) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('login');
        }

        // Authenticated but not admin -> forbidden
        if (!$user->is_admin) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Forbidden. Admins only.'], 403);
            }
            return redirect('/')->with('error', 'Akses ditolak — hanya admin.');
        }

        return $next($request);
    }
}
