<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnonceController extends Controller
{
    /**
     * Afficher la liste des annonces.
     */
    public function index()
    {
        $annonces = Annonce::with('bien', 'proprietaire')->get();
        return response()->json($annonces);
    }

    /**
     * Créer une nouvelle annonce.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_publication' => 'required|date',
            'description' => 'required|string',
            'titre' => 'required|string',
            'image' => 'nullable|string',
            'video' => 'nullable|string',
            'bien_id' => 'required|exists:bien_immobilier,id',
            'proprietaire_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $annonce = Annonce::create($request->all());
        return response()->json($annonce, 201);
    }

    /**
     * Afficher une annonce spécifique.
     */
    public function show($id)
    {
        $annonce = Annonce::with('bien', 'proprietaire')->findOrFail($id);
        return response()->json($annonce);
    }

    /**
     * Mettre à jour une annonce spécifique.
     */
    public function update(Request $request, $id)
    {
        $annonce = Annonce::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'date_publication' => 'date',
            'description' => 'string',
            'titre' => 'string',
            'image' => 'nullable|string',
            'video' => 'nullable|string',
            'bien_id' => 'exists:bien_immobilier,id',
    
            'proprietaire_id' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $annonce->update($request->all());
        return response()->json($annonce);
    }

    /**
     * Supprimer une annonce spécifique.
     */
    public function destroy($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();
        return response()->json(null, 204);
    }
}
