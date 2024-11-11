<?php
namespace App\Http\Controllers;

use App\Models\Visite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisiteController extends Controller
{
    public function index()
    {
        $visites = Visite::with('utilisateur')->get(); // Inclut les informations du visiteur
        return response()->json($visites);
    }

    public function planifier(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_visite' => 'required|date',
            'commentaire' => 'nullable|string',
            'status' => 'required|in:Programmé,Effectué,Annulé',
            'bien_id' => 'required|exists:bien_immobilier,id',
            'visiteur_id'  => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $visite = Visite::create($request->all());
        $visite->load('utilisateur'); // Charge les informations de l'utilisateur
        return response()->json($visite, 201);
    }

    public function show($id)
    {
        $visite = Visite::with('utilisateur')->findOrFail($id);
        return response()->json($visite);
    }

    public function update(Request $request, $id)
    {
        $visite = Visite::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'date_visite' => 'date',
            'commentaire' => 'nullable|string',
            'status' => 'in:Programmé,Effectué,Annulé',
            'bien_id' => 'exists:bien_immobilier,id',
            'visiteur_id' => 'exists:utilisateurs,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $visite->update($request->all());
        $visite->load('utilisateur'); // Charge les informations de l'utilisateur
        return response()->json($visite);
    }

    public function destroy($id)
    {
        $visite = Visite::findOrFail($id);
        $visite->delete();
        return response()->json(['message' => 'Visite supprimée'], 204);
           }

      
     // Confirmer une visite
     public function confirmer($id)
     {
         $visite = Visite::findOrFail($id);
         $visite->update(['status' => 'Effectué']);
 
         return response()->json(['message' => 'Visite confirmée avec succès']);
     }
 
}
