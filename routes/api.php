<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\BienImmobilierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'auth']);


Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Définition des routes pour les biens
Route::apiResource('biens', BienImmobilierController::class);
Route::get('search', [BienImmobilierController::class, 'search']);
Route::post('biens/{id}/upload-image', [BienImmobilierController::class, 'uploadImage']);


// Définition des routes pour les annonces
Route::apiResource('annonces', AnnonceController::class);
