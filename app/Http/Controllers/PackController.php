<?php


namespace App\Http\Controllers;

use App\Models\Pack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackController extends Controller
{
    public function payerPack(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour acheter un pack.');
        }

        $user = Auth::user();
        $packId = $request->input('pack_id');
        
        // Récupérer les informations du pack
        $pack = Pack::findOrFail($packId);

        // Logique pour traiter le paiement
        // Vous pouvez intégrer ici une passerelle de paiement comme Stripe, PayPal, etc.
        
        // Si le paiement est validé, enregistrer la transaction
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->pack_id = $pack->id;
        $transaction->montant = $pack->prix;
        $transaction->status = 'success'; // Vous pouvez mettre en place un système de statut
        $transaction->save();

        // Rediriger vers une page de confirmation de paiement
        return redirect()->route('paiement.success')->with('success', 'Votre paiement a été effectué avec succès.');
    }

    public function showPacks()
{
    $packs = Pack::all(); // Récupère tous les packs
    return view('Home.vendreBien', compact('packs')); // Passe les packs à la vue
}

    public function VoirPacks()
    {
        $packs = Pack::all(); // Récupère tous les packs
        return view('Proprietaire.listePack', compact('packs')); // Passe les packs à la vue
    }

    // Liste tous les packs disponibles
    public function index()
    {
        $packs = Pack::all();
        return view('Admin.Pack.pack', compact('packs'));
    }
     // Liste tous les packs disponibles
     public function indexProprio()
     {
         $packs = Pack::all();
         return view('Proprietaire.listePack', compact('packs'));
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
