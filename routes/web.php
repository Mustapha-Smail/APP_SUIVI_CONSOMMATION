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

// DASHBOARD Gle
Route::get('/profile', [DashboardController::class, 'profile'])->middleware(['auth','verified'])->name('profile');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth','verified'])->name('dashboard');
Route::get('/dashboard-admin', [DashboardController::class, 'admin'])->middleware(['auth','verified'])->name('admin.dashboard');

// PROPRIETAIRE 
Route::get('/maisons', [ProprietaireController::class, 'index'])->middleware(['auth','verified'])->name('proprietaire.maisons');
Route::get('/appartements/{maison_id}', [ProprietaireController::class, 'appartements'])->middleware(['auth','verified'])->name('proprietaire.appartements');
Route::get('/ajout-maison', [ProprietaireController::class, 'ajoutMaison'])->middleware(['auth','verified'])->name('proprietaire.ajout-maison');
Route::post('/ajout-maison', [ProprietaireController::class, 'storeMaison'])->middleware(['auth','verified']);

// LOCATAIRES 
Route::get('/appartements', [LocataireController::class, 'index'])->middleware(['auth','verified'])->name('locataire.appartements');
Route::get('/pieces/{appartement_id}', [LocataireController::class, 'pieces'])->middleware(['auth','verified'])->name('locataire.pieces');

require __DIR__.'/auth.php';

Route::get('/villes', [VilleController::class, 'index'])->name('villes'); 