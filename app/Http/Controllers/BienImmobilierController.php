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

    public function search(Request $request)
    {
        $query = Bien::query();

        if ($request->has('prix_min')) {
            $query->where('prix', '>=', $request->input('prix_min'));
        }

        if ($request->has('prix_max')) {
            $query->where('prix', '<=', $request->input('prix_max'));
        }

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        $biens = $query->get();

        return response()->json($biens);
    }

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
}
