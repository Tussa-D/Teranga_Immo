<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  
    // Afficher la liste des utilisateurs
    public function index()
    {
        // Récupérer tous les utilisateurs
        $users = User::all();

        // Retourner la vue avec la liste des utilisateurs
        return view('Admin.User', compact('users'));
    }
    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }

}
