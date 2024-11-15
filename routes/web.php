<?php
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\AnnonceController;
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
Route::post('/register', [AuthController::class, 'register']);
// Gérer la déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Protéger les routes qui nécessitent une authentification
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::delete('/profile', [AuthController::class, 'deleteAccount']);
});



//route qui marche


Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/proprietaire', [ProprietaireController::class, 'index']);


Route::get('/', function () {
    return view('Home.home');
});


Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces');
Route::post('/annonces', [AnnonceController::class, 'store'])->name('annonces.store');


Route::get('/bien', [BienImmobilierController::class, 'index'])->name('bien');
Route::delete('/biens/{bien}', [BienImmobilierController::class, 'destroy'])->name('biens.destroy');
Route::put('/biens/{bien}', [BienImmobilierController::class, 'update'])->name('biens.update');




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


// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin', function () {
//         return view('Admin.User');
//     })->name('admin');

//     Route::get('/home', function () {
//         return view('home');
//     })->name('home');

//     Route::get('/proprietaire', function () {
//         return view('proprietaire.dashboard');
//     })->name('proprietaire.dashboard');
// });






// // Gestion des biens immobiliers
// Route::resource('biens', BienImmobilierController::class);
// Route::post('biens/{id}/upload-image', [BienImmobilierController::class, 'uploadImage']);
// Route::get('/search', [BienImmobilierController::class, 'search']);

// // Gestion des annonces
// Route::resource('annonces', AnnonceController::class);

// // Gestion des packs
// Route::resource('packs', PackController::class);

// // Gestion des visites (réservé aux administrateurs)
// Route::middleware(['auth:sanctum', 'admin'])->prefix('visites')->group(function () {
//     Route::post('/', [VisiteController::class, 'planifier']);  // Planifier une visite
//     Route::get('/', [VisiteController::class, 'index']);       // Liste des visites
//     Route::get('/{id}', [VisiteController::class, 'show']);    // Détails d'une visite
//     Route::put('/{id}', [VisiteController::class, 'update']);  // Mise à jour d'une visite
//     Route::delete('/{id}', [VisiteController::class, 'destroy']); // Suppression d'une visite
//     Route::patch('/{id}/confirmer', [VisiteController::class, 'confirmer']); // Confirmer une visite
// });
