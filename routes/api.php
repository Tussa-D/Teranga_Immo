<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\BienImmobilierController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
        //utilisateur
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'auth']);
Route::get('/index', [AuthController::class, 'index']);

        // Définition des routes pour la suppression , modification et recherche d utilisateur
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'show']);
    Route::put('/profile', [AuthController::class, 'update']);
    Route::delete('/profile', [AuthController::class, 'destroy']);
});


        // Définition des routes pour les biens
Route::apiResource('biens', BienImmobilierController::class);
//Route::get('search', [BienImmobilierController::class, 'search']);
Route::post('biens/{id}/upload-image', [BienImmobilierController::class, 'uploadImage']);
Route::get('/search', [BienImmobilierController::class, 'search']);




        // Définition des routes pour les annonces
Route::apiResource('annonces', AnnonceController::class);

Route::apiResource('packs', PackController::class);


Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // Créer une nouvelle visite
    Route::post('/visites', [VisiteController::class, 'planifier']);
// Liste de toutes les visites avec les détails des utilisateurs
Route::get('/visites', [VisiteController::class, 'index']);
 // Route pour afficher une visite spécifique
 Route::get('/visites/{id}', [VisiteController::class, 'show']);
 // Route pour mettre à jour une visite existante
 Route::put('/visites/{id}', [VisiteController::class, 'update']);
 // Route pour supprimer une visite
 Route::delete('/visites/{id}', [VisiteController::class, 'destroy']);
 // Route spécifique pour confirmer une visite
 Route::patch('/visites/{id}/confirmer', [VisiteController::class, 'confirmer']);

});


