<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Si el usuario no está logueado o su rol no está en la lista → 403
        if (! $user || ! in_array($user->role, $roles)) {
            abort(403, 'No tienes permisos para acceder a esta ruta.');
        }

        return $next($request);
    }
}
