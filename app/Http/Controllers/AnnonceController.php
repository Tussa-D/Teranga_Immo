<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Bien;
use App\Models\User;
use Illuminate\Support\Facades\Storage;



class AnnonceController extends Controller
{
    /**
     * Afficher la liste des annonces.
     */
    public function index()
    {
          // Récupérer tous les biens immobiliers
    $biens = Bien::all();
    
    // Récupérer tous les propriétaires
    $proprietaires = User::where('role', 'proprietaire')->get();
    
    // Récupérer les annonces avec la pagination
    $annonces = Annonce::with('bien', 'proprietaire')->paginate(10);

    // Passer les variables $biens, $annonces, et $proprietaires à la vue
    return view('Admin.Annonce', compact('biens', 'annonces', 'proprietaires'));
    }

    /**
     * Afficher le formulaire de création d'une nouvelle annonce.
     */
    public function create()
    {
        $proprietaires = User::where('role', 'proprietaire')->get();
      
        // Récupérer tous les biens
        $biens = Bien::all(); // Vous pouvez ajouter des filtres si nécessaire
    
        // Passer les biens à la vue
        return view('Admin.Annonce.create', compact('biens', 'proprietaires'));

    }

    /**
     * Créer une nouvelle annonce.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_publication' => 'required|date',
            'statut' => 'required|in:En cours,Active,Suspended,Expired,Archived', // Validation des statuts valides
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image optionnelle, avec types et taille limités
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200', // Vidéo optionnelle, avec types et taille limite de 50MB
            'bien_id' => 'required|exists:bien_immobilier,id', // Validation pour s'assurer que le bien existe
            'proprietaire_id' => 'required|exists:users,id', // Validation pour s'assurer que le propriétaire existe
        ]);
    
        // Créer une nouvelle annonce
        $annonce = new Annonce();
        
        // Attribuer les données de la requête à l'annonce
        $annonce->titre = $request->titre;
        $annonce->description = $request->description;
        $annonce->date_publication = Carbon::parse($request->date_publication)->format('Y-m-d');
        $annonce->bien_id = $request->bien_id;
        $annonce->proprietaire_id = $request->proprietaire_id;
        $annonce->statut = $request->statut;
    
        // Gérer l'upload de l'image (si présente)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/annonces', 'public');
            $annonce->image = $imagePath;
        }
    
        // Gérer l'upload de la vidéo (si présente)
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos/annonces', 'public');
            $annonce->video = $videoPath;
        }
    
        // Sauvegarder l'annonce dans la base de données
        $annonce->save();
    
        // Retourner une réponse ou rediriger
        return redirect()->route('annonces.index')->with('success', 'Annonce ajoutée avec succès');
    }
    

    /**
     * Afficher une annonce spécifique.
     */
    public function show($id)
    {
        $annonce = Annonce::with('bien', 'proprietaire')->findOrFail($id);
        return view('Admin.Annonce.show', compact('annonce'));
    }

    /**
     * Afficher le formulaire d'édition d'une annonce spécifique.
     */
   /**
 * Afficher le formulaire d'édition d'une annonce spécifique.
 */
public function edit($id)
{
    $annonce = Annonce::findOrFail($id);
    $biens = Bien::all();  // Liste des biens à associer à l'annonce
    $proprietaires = User::where('role', 'proprietaire')->get();  // Liste des propriétaires
    return view('Admin.Annonce.edit', compact('annonce', 'biens', 'proprietaires'));
}

    /**
     * Mettre à jour une annonce spécifique.
     */
    public function update(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_publication' => 'required|date',
            'statut' => 'required|in:En cours,Active,Suspended,Expired,Archived', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200',
           'bien_id' => 'required|exists:bien_immobilier,id',
            'proprietaire_id' => 'required|exists:users,id',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Trouver l'annonce à modifier
        $annonce = Annonce::findOrFail($id);
    
        // Mettre à jour les données de l'annonce
        $annonce->titre = $request->titre;
        $annonce->description = $request->description;
        $annonce->date_publication = Carbon::parse($request->date_publication)->format('Y-m-d');
        $annonce->statut = $request->statut;
        $annonce->bien_id = $request->bien_id;
        $annonce->proprietaire_id = $request->proprietaire_id;
    
        // Gérer l'upload de l'image (si présente)
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($annonce->image) {
                Storage::delete($annonce->image);
            }
            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('images/annonces', 'public');
            $annonce->image = $imagePath;
        }
    
        // Gérer l'upload de la vidéo (si présente)
        if ($request->hasFile('video')) {
            // Supprimer l'ancienne vidéo si elle existe
            if ($annonce->video) {
                Storage::delete($annonce->video);
            }
            // Stocker la nouvelle vidéo
            $videoPath = $request->file('video')->store('videos/annonces', 'public');
            $annonce->video = $videoPath;
        }
    
        // Sauvegarder l'annonce mise à jour
        $annonce->save();
    
        // Rediriger avec un message de succès
        return redirect()->route('annonces.index')->with('success', 'Annonce mise à jour avec succès.');
    }
    

    /**
     * Supprimer une annonce spécifique.
     */
    public function destroy($id)
    {
        // Trouver l'annonce à supprimer
        $annonce = Annonce::findOrFail($id);
    
        // Supprimer les fichiers associés (image et vidéo)
        if ($annonce->image) {
            Storage::delete($annonce->image);
        }
        if ($annonce->video) {
            Storage::delete($annonce->video);
        }
    
        // Supprimer l'annonce de la base de données
        $annonce->delete();
    
        // Rediriger avec un message de succès
        return redirect()->route('annonces.index')->with('success', 'Annonce ajoutée avec succès');
    }
    
}
