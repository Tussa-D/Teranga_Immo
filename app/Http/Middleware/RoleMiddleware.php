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
   
     public function handle($request, Closure $next, $role)
     {
    

        // Ajoutez un log pour vérifier que le middleware est bien appelé
        Log::info('Middleware Role : Vérification du rôle pour l\'utilisateur', [
            'user_email' => Auth::user()->email,
            'role_requis' => $role
        ]);
        
        // Vérifiez si l'utilisateur est authentifié et si son rôle correspond au rôle attendu
        if (Auth::check()) {
            Log::info('Utilisateur authentifié : ' . Auth::user()->email);
            if (Auth::user()->role === $role) {
                Log::info('Accès autorisé pour le rôle : ' . $role);
                return $next($request);
            } else {
                Log::warning('Rôle de l\'utilisateur non autorisé : ' . Auth::user()->role);
            }
        } else {
            Log::warning('Utilisateur non authentifié.');
        }

       

        // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
    }
}
