<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function __construct()
    {
        // Applique le middleware "auth" à toutes les méthodes sauf celles spécifiées ici
        $this->middleware('auth')->except([
            'showLoginForm',
            'login',
            'showRegisterForm',
            'register',
        ]);
    }

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
         

            if (Auth::check()) {
                
                \Log::info('Utilisateur authentifié avec succès : ' . $user->email);
            } else {
                \Log::error('Problème d\'authentification pour : ' . $request->email);
                return back()->withErrors(['error' => 'Échec de l\'authentification'])->withInput();
            }
            

            if (session()->has('redirect_url')) {
                $redirect_url = session('redirect_url');
                session()->forget('redirect_url'); // Supprime l'URL après utilisation
                return redirect($redirect_url)->with('success', 'Bienvenue, vous pouvez poursuivre votre réservation.');
            }

                        // Redirection en fonction du rôle de l'utilisateur
                        // Redirection en fonction du rôle de l'utilisateur
            if ($user->role === 'admin') {
                Log::info('Redirection vers la page Admin pour : ' . $user->email); // Log avant la redirection
                return redirect()->route('admin')->with('success', 'Bienvenue, Admin');
            } elseif ($user->role === 'proprietaire') {
                Log::info('Redirection vers la page Propriétaire pour : ' . $user->email); // Log avant la redirection
                return redirect()->route('proprietaire')->with('success', 'Bienvenue, Propriétaire');
            } elseif ($user->role === 'client') {
                Log::info('Redirection vers la page Client pour : ' . $user->email); // Log avant la redirection
                return redirect()->route('home')->with('success', 'Bienvenue sur la page d\'accueil');
            } else {
                Log::info('Redirection vers la page d\'accueil par défaut pour : ' . $user->email); // Log avant la redirection
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
                'password' => 'required|confirmed|min:6',
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'tel' => 'required|string|max:20',
                'ville' => 'required|string|max:255',
            ]);
    
            try {
                // Création de l'utilisateur
                $user = User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'tel' => $request->tel,
                    'ville' => $request->ville,
                ]);
    
                // Connexion de l'utilisateur après l'inscription
                Auth::login($user);
    
                // Redirection avec un message de succès
                return redirect()->route('home')->with('success', 'Utilisateur créé et connecté avec succès');
            } catch (\Exception $e) {
                // En cas d'erreur
                return back()->with('error', 'Erreur lors de l\'inscription. Veuillez réessayer.');
            }
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
