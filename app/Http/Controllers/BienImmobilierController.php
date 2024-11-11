<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BienImmobilierController extends Controller
{
    /**
     * Afficher une liste des biens immobiliers.
     */
    public function index()
    {
        $biens = Bien::all();
        return response()->json($biens);
    }

    /**
     * Stocker un nouveau bien immobilier.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'Nbpiece' => 'required|integer',
            'adresse' => 'required|string',
            'surface' => 'required|numeric',
            'type' => 'required|string',
            'video' => 'nullable',
            'image' => 'nullable',
            'statut' => 'required|in:Disponible,Sous Offre,Vendu,Retiré',
            'proprietaire_id' => 'required|exists:users,id',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $bien = Bien::create($request->all());
        return response()->json($bien, 201);
    }

    /**
     * Afficher un bien immobilier spécifique.
     */
    public function show($id)
    {
        $bien = Bien::findOrFail($id);
        return response()->json($bien);
    }

    /**
     * Mettre à jour un bien immobilier spécifique.
     */
    public function update(Request $request, $id)
    {
        $bien = Bien::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'titre' => 'string|max:255',
            'description' => 'string',
            'prix' => 'numeric',
            'Nbpiece' => 'integer',
            'adresse' => 'string',
            'surface' => 'numeric',
            'type' => 'string',
            'video' => 'nullable|string',
            'image' => 'nullable|string',
            'statut' => 'in:Disponible,Sous Offre,Vendu,Retiré',
            'proprietaire_id' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $bien->update($request->all());
        return response()->json($bien);
    }

    /**
     * Supprimer un bien immobilier spécifique.
     */
    public function destroy($id)
    {
        $bien = Bien::findOrFail($id);
        $bien->delete();
        return response()->json([
            'message' => 'Bien supprimé'
        ], 401); // Unauthorized
        //return response()->json(null, 204);
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
        // Validation des paramètres de recherche
        $validator = Validator::make($request->all(), [
            'type' => 'nullable|string',
            'localisation' => 'nullable|string',
            'nb_piece' => 'nullable|integer',
            'prix_min' => 'nullable|numeric',
            'prix_max' => 'nullable|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Paramètres de recherche invalides',
                'details' => $validator->errors()
            ], 400);
        }
    
        $query = Bien::query();
    
        // Filtrer par prix
        if ($request->has('prix_min')) {
            $query->where('prix', '>=', $request->input('prix_min'));
        }
    
        if ($request->has('prix_max')) {
            $query->where('prix', '<=', $request->input('prix_max'));
        }
    
        // Filtrer par type
        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }
    
        // Filtrer par localisation
        if ($request->has('localisation')) {
            $query->where('adresse', 'like', '%' . $request->input('localisation') . '%');
        }
    
        // Filtrer par nombre de pièces
        if ($request->has('nb_piece')) {
            $query->where('Nbpiece', '=', $request->input('nb_piece'));
        }


            // Filtrer par prix
            if ($request->has('prix_min')) {
                $query->where('prix', '>=', $request->input('prix_min'));
            }

            if ($request->has('prix_max')) {
                $query->where('prix', '<=', $request->input('prix_max'));
            }   
    
        $biens = $query->get();
    
        if ($biens->isEmpty()) {
            return response()->json(['message' => 'Aucun bien trouvé avec les critères spécifiés'], 404);
        }
    
        return response()->json($biens);
    }
    

}
