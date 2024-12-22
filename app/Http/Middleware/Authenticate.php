<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        // Si l'utilisateur n'est pas authentifié, rediriger vers la page de connexion
        if (!$request->expectsJson()) {
            return route('login'); // Assurez-vous que la route 'login' existe
        }
    }
}
