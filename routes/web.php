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

Route::get('/', function () {
    return view('welcome');
});

// Route GET pour afficher le formulaire de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route POST pour traiter la soumission du formulaire de connexion
Route::post('/login', [AuthController::class, 'login']);

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

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/proprietaire', [ProprietaireController::class, 'index']);

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
