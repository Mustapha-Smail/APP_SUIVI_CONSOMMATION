<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth','verified'])->name('dashboard');
Route::get('/profile', [DashboardController::class, 'profile'])->middleware(['auth','verified'])->name('profile');

require __DIR__.'/auth.php';

Route::get('/villes', [VilleController::class, 'index'])->name('villes'); 