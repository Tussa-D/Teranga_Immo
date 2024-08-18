<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Vérifier si l'email existe dans la base de données
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'error' => 'Email incorrect'
            ], 401); // Unauthorized
        }

        // Vérifier si le mot de passe est correct
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Mot de passe incorrect'
            ], 401); // Unauthorized
        }

        // Authentifier l'utilisateur
        Auth::login($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Connecté avec succès',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'tel' => 'required',
            'ville' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'tel' => $request->tel,
            'ville' => $request->ville,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201); // Created
    }



    public function login()
    {
        return response()->json([
            'message' => 'Login form'
        ]);
    }

    /**
     * Log out the user.
     */
    public function logout(Request $request)
    {
        $user = $request->user();
    
        if ($user) {
            $request->user()->currentAccessToken()->delete();
    
            return response()->json([
                'message' => 'Déconnexion réussie'
            ]);
        } else {
            return response()->json([
                'error' => 'Utilisateur non trouvé'
            ], 404); // Not Found
        }
    }
    
}
