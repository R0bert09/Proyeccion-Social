<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next ,string $rol): Response
    {
        // Verificamos si el parámetro $role ha sido pasado
        if ($rol == null) {
            return redirect()->route('home')->with('error', 'Rol no especificado.');
        }

        //Obtenemos el usuario autenticado
        $user = auth()->user();

        // Verificamos si el usuario está autenticado y si tiene el rol necesario
        if (!$user || !$user->hasRole($rol)) {
            return redirect()->route('home')->with('error', 'No tienes permisos para acceder a esta página.');
        }

        // Si todo está bien, dejamos pasar la solicitud
        return $next($request);
    }
}
