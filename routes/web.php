<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieNiveauController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\ClasseController;  
use App\Http\Controllers\TarifClasseController;
use App\Http\Controllers\AnneeAcademiqueController; // Ajout de l'import

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// ========== Catégorie Niveau ==========
Route::get('/categorie-niveau/create', [CategorieNiveauController::class, 'create']);
Route::post('/categorie-niveau/store', [CategorieNiveauController::class, 'store']);
Route::get('/categorie-niveau/edit/{id}', [CategorieNiveauController::class, 'edit']);
Route::put('/categorie-niveau/update/{id}', [CategorieNiveauController::class, 'update']);
Route::delete('/categorie-niveau/destroy/{id}', [CategorieNiveauController::class, 'destroy']);

// ========== Filière ==========
Route::get('/filiere/create', [FiliereController::class, 'create']);
Route::post('/filiere/store', [FiliereController::class, 'store']);
Route::get('/filiere/edit/{id}', [FiliereController::class, 'edit']);
Route::put('/filiere/update/{id}', [FiliereController::class, 'update']);
Route::delete('/filiere/destroy/{id}', [FiliereController::class, 'destroy']);

// ========== Niveaux ==========
Route::get('/niveaux/create', [NiveauController::class, 'create']);
Route::post('/niveaux/store', [NiveauController::class, 'store']);
Route::get('/niveaux/edit/{id}', [NiveauController::class, 'edit']);
Route::put('/niveaux/update/{id}', [NiveauController::class, 'update']);
Route::delete('/niveaux/destroy/{id}', [NiveauController::class, 'destroy']);

// ========== Classe ==========
Route::get('/classe/create', [ClasseController::class, 'create']);
Route::post('/classe/store', [ClasseController::class, 'store']);
Route::get('/classe/edit/{id}', [ClasseController::class, 'edit']);
Route::put('/classe/update/{id}', [ClasseController::class, 'update']);
Route::delete('/classe/destroy/{id}', [ClasseController::class, 'destroy']);

// ========== Tarif ==========
Route::get('/tarif/create', [TarifController::class, 'create']);
Route::post('/tarif/store', [TarifController::class, 'store']);
Route::get('/tarif/edit/{id}', [TarifController::class, 'edit']);
Route::put('/tarif/update/{id}', [TarifController::class, 'update']);
Route::delete('/tarif/destroy/{id}', [TarifController::class, 'destroy']);

// ========== Tarif-Classe ==========
Route::get('/tarif-classe/create', [TarifClasseController::class, 'create']);
Route::post('/tarif-classe/store', [TarifClasseController::class, 'store']);
Route::get('/tarif-classe/edit/{id}', [TarifClasseController::class, 'edit']);
Route::put('/tarif-classe/update/{id}', [TarifClasseController::class, 'update']);
Route::delete('/tarif-classe/destroy/{id}', [TarifClasseController::class, 'destroy']);

// ========== Année Académique ==========
Route::get('/annee-academique/create', [AnneeAcademiqueController::class, 'create']);
Route::post('/annee-academique/store', [AnneeAcademiqueController::class, 'store']);
Route::get('/annee-academique/edit/{id}', [AnneeAcademiqueController::class, 'edit']);
Route::put('/annee-academique/update/{id}', [AnneeAcademiqueController::class, 'update']);
Route::delete('/annee-academique/destroy/{id}', [AnneeAcademiqueController::class, 'destroy']);

// Actions de changement de statut pour Année Académique
Route::post('/annee-academique/publier/{id}', [AnneeAcademiqueController::class, 'publier']);
Route::post('/annee-academique/ouvrir-inscriptions/{id}', [AnneeAcademiqueController::class, 'ouvrirInscriptions']);
Route::post('/annee-academique/fermer-inscriptions/{id}', [AnneeAcademiqueController::class, 'fermerInscriptions']);
Route::post('/annee-academique/cloturer/{id}', [AnneeAcademiqueController::class, 'cloturer']);