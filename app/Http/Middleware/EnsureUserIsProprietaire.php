<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsProprietaire
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        // Vérifie que l'utilisateur est authentifié et qu'il a le rôle "proprietaire"
        if (Auth::check() && Auth::user()->role === 'proprietaire') {
            return $next($request);
        }

        // Redirige si l'utilisateur n'est pas un propriétaire
        return redirect()->route('login')->with('error', 'Accès réservé aux propriétaires.');
    }
}
