<?php


namespace App\Http\Controllers;

use App\Models\Pack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackController extends Controller
{
    // Liste tous les packs disponibles
    public function index()
    {
        $packs = Pack::all();
        return response()->json($packs);
    }

    // Créer un nouveau pack
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'prix' => 'required|numeric',
            'duree' => 'required|integer',
            'nombre_annonces' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $pack = Pack::create($request->all());
        return response()->json($pack, 201);
    }

    // Afficher un pack spécifique
    public function show($id)
    {
        $pack = Pack::findOrFail($id);
        return response()->json($pack);
    }

    // Mettre à jour un pack
    public function update(Request $request, $id)
    {
        $pack = Pack::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nom' => 'string',
            'prix' => 'numeric',
            'duree' => 'integer',
            'nombre_annonces' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $pack->update($request->all());
        return response()->json($pack);
    }

    // Supprimer un pack
    public function destroy($id)
    {
        $pack = Pack::findOrFail($id);
        $pack->delete();
        return response()->json(null, 204);
    }
}
