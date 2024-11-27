<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClientController extends Controller
{
    public function index()
    {
        return view('Client.client');
    }
    public function indexBien()
    {
            $biens = Bien::paginate(10);
            $annonces = Annonce::with('proprietaire')->get();
    
            return view('Client.listBien', compact('annonces', 'biens')); // Passez chaque variable séparément
    }
}
