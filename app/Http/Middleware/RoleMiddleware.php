<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    // El ...$roles permite pasar varios roles separados por coma: 'admin,manager'
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $userRole = Auth::user()->role;

        // Si el rol del usuario está en la lista de permitidos, pasa.
        // Si es admin, le dejamos pasar siempre (opcional, pero útil).
        if (in_array($userRole, $roles) || $userRole === 'admin') {
            return $next($request);
        }

        abort(403, 'No tienes permiso para acceder a esta página.');
    }
}
