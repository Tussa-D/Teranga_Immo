<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmation;


class BienImmobilierController extends Controller
{
        // Afficher le formulaire de connexion
        public function create()
        {

        // Récupérer les utilisateurs ayant le rôle "proprietaire"
        $proprietaires = User::where('role', 'proprietaire')->get();
        return view('Admin.Bien.addBien', compact('proprietaires'));
            
        }  

    /**
     * Afficher une liste des biens immobiliers.
     */
    public function index()
    {
        $biens = Bien::paginate(10);
        return view('Admin.Bien.listeBien', compact('biens'));
    }

    public function indexHome()
{
        $biens = Bien::paginate(10);
        $annonces = Annonce::with('proprietaire')->get();

        return view('Home.listBien', compact('annonces', 'biens')); // Passez chaque variable séparément
}

   

    public function show($id)
        {
            $property = Bien::with('proprietaire')->findOrFail($id); // Inclure le propriétaire et autres relations si nécessaires
            return view('Home.detailBien', compact('property'));
        }

      
        public function reserve($id)
        {
           
            $property = Bien::findOrFail($id);  // Trouver la propriété
        
            // Créer la réservation
            $reservation = Reservation::create([
                'bien_id' => $property->id,
                'user_id' => auth()->id(),  // L'utilisateur connecté
                'reservation_date' => now(),  // Date de la réservation
            ]);
        
              // Rediriger avec un message de succès
            return redirect()->route('property.details', ['id' => $property->id])
            
                             ->with('success', 'Réservation réussie! Un email de confirmation a été envoyé.');
        }
        
            // Contacter le propriétaire
            public function contactOwner($id)
            {
                $bien = Bien::findOrFail($id);  // Utilisation du modèle Bien pour trouver le bien
        
                // Logique pour contacter le propriétaire (par exemple, envoyer un email)
                // Vous pouvez ajouter la logique nécessaire ici
        
                return redirect()->route('Home.detailBien', ['id' => $bien->id])
                                 ->with('success', 'Message envoyé au propriétaire!');
            }
        
        


    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'Nbpiece' => 'required|integer',
            'adresse' => 'required|string',
            'surface' => 'required|numeric',
            'type' => 'required|string',
    
            'statut' => 'required|in:Disponible,Sous Offre,Vendu,Retiré',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10240',  // Taille de fichier max 10 Mo
            'video' => 'nullable|mimes:mp4,mkv,avi|max:50000',  // Taille de fichier max 50 Mo
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('biens.create')
                             ->withErrors($validator)
                             ->withInput();
        }
    
        // Gestion de l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Stocke l'image dans le dossier 'images' du répertoire public
            $imagePath = $request->file('image')->store('images', 'public');
        }
    
        // Gestion de la vidéo
        $videoPath = null;
        if ($request->hasFile('video')) {
            // Stocke la vidéo dans le dossier 'videos' du répertoire public
            $videoPath = $request->file('video')->store('videos', 'public');
        }
    
        // Création du bien immobilier
        Bien::create([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'prix' => $request->input('prix'),
            'Nbpiece' => $request->input('Nbpiece'),
            'adresse' => $request->input('adresse'),
            'surface' => $request->input('surface'),
            'type' => $request->input('type'),
            'statut' => $request->input('statut'),
            'image' => $imagePath,   // Chemin relatif de l'image
            'video' => $videoPath,   // Chemin relatif de la vidéo
            'proprietaire_id' => $request->input('proprietaire_id') 
        ]);
    
        // Message de succès
        return redirect()->route('biens.create')->with('success', 'Le bien immobilier a été ajouté avec succès.');
    }
    
    

    
   //telecharger l image

    public function uploadImage(Request $request, $id)
    {
        $bien = Bien::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/biens');
            $image->move($destinationPath, $name);

            $bien->image = '/images/biens/'.$name;
            $bien->save();

            return response()->json(['message' => 'Image téléchargée avec succès', 'path' => $bien->image]);
        }

        return response()->json(['error' => 'Aucune image n\'a été téléchargée'], 400);
    }

    //rechercher
    public function search(Request $request)
    {
        $query = Bien::query();
    
        // Appliquer les filtres de recherche selon les critères
        if ($request->filled('prix_min')) {
            $query->where('prix', '>=', $request->input('prix_min'));
        }
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->input('prix_max'));
        }
        if ($request->filled('type')) {
            $query->whereIn('type', $request->input('type'));  // Rechercher plusieurs types si sélectionnés
        }
        if ($request->filled('localisation')) {
            $query->where('adresse', 'like', '%' . $request->input('localisation') . '%');
        }
        if ($request->filled('Nbpiece')) {
            $query->where('Nbpiece', '=', $request->input('Nbpiece'));
        }
    
        // Exécuter la requête et récupérer les résultats
        $biens = $query->paginate(10);  // Pagination des résultats
        return view('Home.listesearch', compact('biens'));
    }
    
  public function showSearchResults(Request $request)
{
    // Initialisation de la requête de base pour les objets Bien
    $query = Bien::query();

    // Appliquer les filtres de recherche selon les critères
    if ($request->filled('prix_min')) {
        $query->where('prix', '>=', $request->input('prix_min'));
    }
    if ($request->filled('prix_max')) {
        $query->where('prix', '<=', $request->input('prix_max'));
    }
    if ($request->filled('type')) {
        $query->whereIn('type', $request->input('type'));  // Rechercher plusieurs types si sélectionnés
    }
    if ($request->filled('localisation')) {
        $query->where('adresse', 'like', '%' . $request->input('localisation') . '%');
    }
    if ($request->filled('Nbpiece')) {
        $query->where('Nbpiece', '=', $request->input('Nbpiece'));
    }

    // Exécuter la requête et récupérer les résultats
    $biens = $query->paginate(10);  // Pagination des résultats

    // Récupération des annonces avec les propriétaires
    $annonces = Annonce::with('proprietaire')->get();

    // Afficher la vue avec les résultats
    return view('Home.home.listeSearch', compact('biens', 'annonces'));
}

    public function update(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'Nbpiece' => 'required|integer',
            'adresse' => 'required|string',
            'surface' => 'required|numeric',
            'type' => 'required|string',
            'statut' => 'required|in:Disponible,Sous Offre,Vendu,Retiré',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10240',  // Taille de fichier max 10 Mo
            'video' => 'nullable|mimes:mp4,mkv,avi|max:50000',  // Taille de fichier max 50 Mo
        ]);
    
        // Si la validation échoue, redirige vers le formulaire d'édition
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Trouver le bien immobilier par son ID
        $bien = Bien::findOrFail($id);
    
        // Mise à jour des données du bien
        $bien->update([
           'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'prix' => $request->input('prix'),
            'Nbpiece' => $request->input('Nbpiece'),
            'adresse' => $request->input('adresse'),
            'surface' => $request->input('surface'),
            'type' => $request->input('type'),
            'statut' => $request->input('statut'),
            'image' => $imagePath,   // Chemin relatif de l'image
            'video' => $videoPath,   // Chemin relatif de la vidéo
            'proprietaire_id' => $request->input('proprietaire_id') 
        ]);
    
        // Gestion de l'image si un fichier est téléchargé
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($bien->image) {
                Storage::delete($bien->image);
            }
            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('images', 'public');
            $bien->image = $imagePath;
        }
    
        // Gestion de la vidéo si un fichier est téléchargé
        if ($request->hasFile('video')) {
            // Supprimer l'ancienne vidéo si elle existe
            if ($bien->video) {
                Storage::delete($bien->video);
            }
            // Stocker la nouvelle vidéo
            $videoPath = $request->file('video')->store('videos', 'public');
            $bien->video = $videoPath;
        }
    
        // Sauvegarder les modifications du bien
        $bien->save();
    
        // Redirige vers l'index avec un message de succès
        return redirect()->route('biens.index')->with('success', 'Le bien immobilier a été mis à jour avec succès.');
    }
    

// Supprimer un bien immobilier
public function destroy($id)
{
    $bien = Bien::findOrFail($id);
    $bien->delete();

    return redirect()->route('biens.index')->with('success', 'Le bien immobilier a été supprimé avec succès.');
}

//     public function search(Request $request)
//     {
//         // Validation des paramètres de recherche
//         $validator = Validator::make($request->all(), [
//             'type' => 'nullable|string',
//             'localisation' => 'nullable|string',
//             'nb_piece' => 'nullable|integer',
//             'prix_min' => 'nullable|numeric',
//             'prix_max' => 'nullable|numeric',
//         ]);
    
//         if ($validator->fails()) {
//             return response()->json([
//                 'error' => 'Paramètres de recherche invalides',
//                 'details' => $validator->errors()
//             ], 400);
//         }
    
//         $query = Bien::query();
    
//         // Filtrer par prix
//         if ($request->has('prix_min')) {
//             $query->where('prix', '>=', $request->input('prix_min'));
//         }
    
//         if ($request->has('prix_max')) {
//             $query->where('prix', '<=', $request->input('prix_max'));
//         }
    
//         // Filtrer par type
//         if ($request->has('type')) {
//             $query->where('type', $request->input('type'));
//         }
    
//         // Filtrer par localisation
//         if ($request->has('localisation')) {
//             $query->where('adresse', 'like', '%' . $request->input('localisation') . '%');
//         }
    
//         // Filtrer par nombre de pièces
//         if ($request->has('nb_piece')) {
//             $query->where('Nbpiece', '=', $request->input('nb_piece'));
//         }


//             // Filtrer par prix
//             if ($request->has('prix_min')) {
//                 $query->where('prix', '>=', $request->input('prix_min'));
//             }

//             if ($request->has('prix_max')) {
//                 $query->where('prix', '<=', $request->input('prix_max'));
//             }   
    
//         $biens = $query->get();
    
//         if ($biens->isEmpty()) {
//             return response()->json(['message' => 'Aucun bien trouvé avec les critères spécifiés'], 404);
//         }
    
//         return response()->json($biens);
//     }
    

 }
