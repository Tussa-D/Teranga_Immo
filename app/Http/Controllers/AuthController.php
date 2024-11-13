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
        // Validation des données d'entrée
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // Vérifier si l'utilisateur existe avec l'email donné
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email incorrect'])->withInput();
        }
    
        // Vérifier si le mot de passe est correct
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Mot de passe incorrect'])->withInput();
        }
    
        // Authentifier l'utilisateur avec Laravel
        Auth::login($user);
    
        // Redirection en fonction du rôle de l'utilisateur
        if ($user->role === 'admin') {
            return redirect()->route('admin')->with('success', 'Bienvenue, Admin');
        } elseif ($user->role === 'proprietaire') {
            return redirect()->route('proprietaire.dashboard')->with('success', 'Bienvenue, Propriétaire');
        } elseif ($user->role === 'client') {
            return redirect()->route('home')->with('success', 'Bienvenue sur la page d\'accueil');
        } else {
            // Par défaut, rediriger vers la page d'accueil si le rôle est inconnu
            return redirect()->route('home')->with('success', 'Bienvenue');
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
