<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocataireController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\VilleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('accueil');
})->middleware(['guest'])->name('accueil');

Route::get('/contact', function() {
    return view('contact'); 
})->middleware(['guest'])->name('contact'); 

// DASHBOARD Gle
Route::get('/profile', [DashboardController::class, 'profile'])->middleware(['auth','verified'])->name('profile');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth','verified'])->name('dashboard');

// ADMIN
Route::get('/users', [DashboardController::class, 'users'])->middleware(['auth','verified'])->name('admin.users'); 
Route::get('/users-age', [DashboardController::class, 'usersage'])->middleware(['auth','verified'])->name('admin.usersage');
Route::post('/users-age', [DashboardController::class, 'searchusersage'])->middleware(['auth','verified']);

// PROPRIETAIRE 
Route::get('/maisons', [ProprietaireController::class, 'index'])->middleware(['auth','verified'])->name('proprietaire.maisons');
Route::get('/appartements/{maison_id}', [ProprietaireController::class, 'appartements'])->middleware(['auth','verified'])->name('proprietaire.appartements');
Route::get('/pieces-proprietaire/{appartement_id}', [ProprietaireController::class, 'pieces'])->middleware(['auth', 'verified'])->name('proprietaire.pieces'); 
Route::get('/ajout-maison', [ProprietaireController::class, 'ajoutMaison'])->middleware(['auth','verified'])->name('proprietaire.ajout-maison');
Route::post('/ajout-maison', [ProprietaireController::class, 'storeMaison'])->middleware(['auth','verified']);
Route::get('/ajout-appartement-proprietaire/{maison_id}', [ProprietaireController::class, 'ajoutAppartementProprietaire'])->middleware(['auth','verified'])->name('proprietaire.ajout-appartement');
Route::post('/ajout-appartement-proprietaire/{maison_id}', [ProprietaireController::class, 'storeAppartementProprietaire'])->middleware(['auth','verified']);


// LOCATAIRES 
Route::get('/appartements', [LocataireController::class, 'index'])->middleware(['auth','verified'])->name('locataire.appartements');
Route::get('/pieces/{appartement_id}', [LocataireController::class, 'pieces'])->middleware(['auth','verified'])->name('locataire.pieces');
Route::get('/piece/{piece_id}', [LocataireController::class, 'piece'])->middleware(['auth','verified'])->name('locataire.piece');
Route::get('/ajout-appartement-locataire',[LocataireController::class, 'ajoutAppartementLocataire'])->middleware(['auth','verified'])->name('locataire.ajout-appartement');
Route::post('/ajout-appartement-locataire',[LocataireController::class, 'storeAppartementLocataire'])->middleware(['auth','verified']);
Route::get('/ajout-pieces-locataire/{id_appartement}',[LocataireController::class, 'ajoutPieceLocataire'])->middleware(['auth','verified'])->name('locataire.ajout-piece');
Route::post('/ajout-pieces-locataire/{id_appartement}',[LocataireController::class, 'storePieceLocataire'])->middleware(['auth','verified']);
Route::get('/ajout-appareils-locataire/{id_piece}',[LocataireController::class, 'ajoutAppareilLocataire'])->middleware(['auth','verified'])->name('locataire.ajout-appareil');
Route::post('/ajout-appareils-locataire/{id_piece}',[LocataireController::class, 'storeAppareilLocataire'])->middleware(['auth','verified']);
Route::post('/consommation',[LocataireController::class, 'consommation'])->middleware(['auth','verified'])->name('locataire.consommation');
Route::get('/consommations/{id_appartement}',[LocataireController::class, 'getConsommations'])->middleware(['auth','verified'])->name('locataire.consommations');
Route::post('/consommations/{id_appartement}',[LocataireController::class, 'postConsommations'])->middleware(['auth','verified']);
Route::get('/emissions/{id_appartement}',[LocataireController::class, 'getEmissions'])->middleware(['auth','verified'])->name('locataire.emissions');
Route::post('/emissions/{id_appartement}',[LocataireController::class, 'postEmissions'])->middleware(['auth','verified']);

require __DIR__.'/auth.php';
