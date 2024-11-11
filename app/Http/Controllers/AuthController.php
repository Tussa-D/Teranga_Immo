<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Authentifier l'utilisateur
    public function login(Request $request)
    {
        // Validation des données
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Vérification des informations d'identification
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirection vers la page d'accueil après connexion réussie
            return redirect()->route('admin')->with('success', 'Connecté avec succès');
        } else {
            // Retour en arrière avec un message d'erreur si l'authentification échoue
            return back()->withErrors(['email' => 'Email ou mot de passe incorrect']);
        }
    }

    // Afficher le formulaire d'inscription
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Enregistrer un nouvel utilisateur
    public function register(Request $request)
    {
        // Validation des données
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'nom' => 'required',
            'prenom' => 'required',
            'tel' => 'required',
            'ville' => 'required',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'tel' => $request->tel,
            'ville' => $request->ville,
        ]);

        // Connexion de l'utilisateur après son enregistrement
        Auth::login($user);

        // Redirection vers la page d'accueil avec un message de succès
        return redirect()->route('home')->with('success', 'Utilisateur créé et connecté avec succès');
    }

    // Déconnecter l'utilisateur
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Déconnexion réussie');
    }

    // Afficher le profil de l'utilisateur
    public function showProfile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    // Modifier le profil de l'utilisateur
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès');
    }

    // Supprimer le compte de l'utilisateur
    public function deleteAccount()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        
        return redirect()->route('register')->with('success', 'Compte supprimé avec succès');
    }
}
