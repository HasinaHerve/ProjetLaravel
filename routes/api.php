<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Actualité
Route::get('/afficherActualite', [App\Http\Controllers\Controleur::class, 'afficherActualite']);
Route::get('/afficherActualite/{id}', [App\Http\Controllers\Controleur::class, 'afficherActualiteId']);
Route::post('/ajouterActualite', [App\Http\Controllers\Controleur::class, 'ajouterActualite']);
Route::put('/modifierActualite/{id}', [App\Http\Controllers\Controleur::class, 'modifierActualite']);
Route::delete('/supprimerActualite/{id}', [App\Http\Controllers\Controleur::class, 'supprimerActualite']);

//Portfolio
Route::get('/afficherPortfolio', [App\Http\Controllers\Controleur::class, 'afficherPortfolio']);
Route::get('/afficherPortfolio/{id}', [App\Http\Controllers\Controleur::class, 'afficherPortfolioId']);
Route::post('/ajouterPortfolio', [App\Http\Controllers\Controleur::class, 'ajouterPortfolio']);
Route::put('/modifierPortfolio/{id}', [App\Http\Controllers\Controleur::class, 'modifierPortfolio']);
Route::delete('/supprimerPortfolio/{id}', [App\Http\Controllers\Controleur::class, 'supprimerPortfolio']);

//Personnel
Route::get('/afficherPersonnel', [App\Http\Controllers\Controleur::class, 'afficherPersonnel']);
Route::get('/afficherPersonnel/{id}', [App\Http\Controllers\Controleur::class, 'afficherPersonnelId']);
Route::post('/ajouterPersonnel', [App\Http\Controllers\Controleur::class, 'ajouterPersonnel']);
Route::put('/modifierPersonnel/{id}', [App\Http\Controllers\Controleur::class, 'modifierPersonnel']);
Route::delete('/supprimerPersonnel/{id}', [App\Http\Controllers\Controleur::class, 'supprimerPersonnel']);
