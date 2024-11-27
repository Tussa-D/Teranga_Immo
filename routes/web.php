<?php
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\CinetPayController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\BienImmobilierController;


// Route GET pour afficher le formulaire de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route POST pour traiter la soumission du formulaire de connexion
Route::post('/login', [AuthController::class, 'login']);
// Modifier un utilisateur sur la page admin 
Route::put('/admin/users/{id}', [AuthController::class, 'update'])->name('users.update');
// Supprimer un utilisateur
Route::delete('/admin/users/{id}', [AuthController::class, 'destroy'])->name('users.destroy');


// Afficher le formulaire d'inscription
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Gérer l'inscription
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
// Gérer la déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Protéger les routes qui nécessitent une authentification
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::delete('/profile', [AuthController::class, 'deleteAccount']);
});



//route de connection
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/proprietaire', [ProprietaireController::class, 'index'])->name('proprietaire');
Route::get('/client', [ClientController::class, 'index'])->name('client');
Route::get('/', function () {
    return view('Home.home');
});


Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces');
Route::post('/annonces', [AnnonceController::class, 'store'])->name('annonces.store');



Route::get('/bien', [BienImmobilierController::class, 'index'])->name('bien');

Route::get('/user/listbien', [ClientController::class, 'indexBien'])->name('listbien');
Route::delete('/biens/{bien}', [BienImmobilierController::class, 'destroy'])->name('biens.destroy');
Route::put('/biens/{bien}', [BienImmobilierController::class, 'update'])->name('biens.update');
Route::get('/property/{id}', [BienImmobilierController::class, 'show'])->name('property.details');
//Reservation



Route::Post('/reservation/{id}', [BienImmobilierController::class, 'reserve'])->name('reservation');

// Route pour contacter le propriétaire
Route::get('/contact-owner/{id}', [BienImmobilierController::class, 'contactOwner'])->name('contact.owner');



// Route GET pour afficher le formulaire de bien
Route::resource('biens', BienImmobilierController::class);
Route::get('biens/search', [BienImmobilierController::class, 'search'])->name('biens.search');
Route::post('/recherche-bien', [BienImmobilierController::class, 'search'])->name('bien.search');
//avoir la liste des bien dans la page home *bouton liste bien
Route::get('/listbienHome', [BienImmobilierController::class, 'indexHome'])->name('home');
Route::get('/biens/create', [BienImmobilierController::class, 'create'])->name('biens.create');
Route::post('/biens/store', [BienImmobilierController::class, 'store'])->name('biens.store');

Route::get('/pack', [PackController::class, 'index'])->name('biens.create');


Route::get('/vendreBien', [PackController::class, 'showPacks'])->name('packs.index');

Route::get('/listPack', [PackController::class, 'VoirPacks'])->name('pack.index');

//

//ROUTE QUI MARCHE

//ROUTE ANNONCE QUI MARCHE



    // Afficher la liste des annonces
    Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces.index');
    // Afficher le formulaire pour ajouter une annonce
    Route::get('/annonces/create', [AnnonceController::class, 'create'])->name('annonces.create');
    // Ajouter une annonce (POST)
    Route::post('/annonces', [AnnonceController::class, 'store'])->name('annonces.store');
    // Afficher le formulaire pour éditer une annonce

    // Mettre à jour une annonce spécifique
    Route::put('/annonces/{id}', [AnnonceController::class, 'update'])->name('annonces.update');
    Route::delete('/annonces/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');

    
    Route::post('/payer-pack', [CinetPayController::class, 'payForPack'])->name('payer.pack');
    Route::get('/payment-success', [CinetPayController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment-cancel', [CinetPayController::class, 'paymentCancel'])->name('payment.cancel');
    