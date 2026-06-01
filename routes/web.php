<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SujetController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\GrhController;

Route::get('/',  fn() => redirect('/login'));
Route::get('/login',  [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

// ── Encadrant : Sujets ──
Route::get('/encadrant/sujets',               [SujetController::class, 'index']);
Route::get('/encadrant/sujets/liste',         [SujetController::class, 'liste']);
Route::get('/encadrant/sujets/stagiaires',    [SujetController::class, 'stagiaires']);
Route::post('/encadrant/sujets',              [SujetController::class, 'store']);
Route::post('/encadrant/sujets/attribuer',    [SujetController::class, 'attribuer']);
Route::get('/encadrant/sujets/{id}',          [SujetController::class, 'show']);
Route::put('/encadrant/sujets/{id}',          [SujetController::class, 'update']);
Route::delete('/encadrant/sujets/{id}',       [SujetController::class, 'destroy']);

// ── Encadrant : Stagiaires ──
Route::get('/encadrant/stagiaires',              [StagiaireController::class, 'index']);
Route::get('/encadrant/stagiaires/liste',        [StagiaireController::class, 'liste']);
Route::get('/encadrant/stagiaires/sujets',       [StagiaireController::class, 'sujetsDisponibles']);
Route::post('/encadrant/stagiaires',             [StagiaireController::class, 'store']);
Route::get('/encadrant/stagiaires/{id}',         [StagiaireController::class, 'show']);
Route::put('/encadrant/stagiaires/{id}',         [StagiaireController::class, 'update']);
Route::delete('/encadrant/stagiaires/{id}',      [StagiaireController::class, 'destroy']);

// ── Encadrant : Rendez-vous ──
Route::get('/encadrant/rendezvous',                  [RendezvousController::class, 'index']);
Route::get('/encadrant/rendezvous/liste',            [RendezvousController::class, 'liste']);
Route::get('/encadrant/rendezvous/stagiaires',       [RendezvousController::class, 'stagiaires']);
Route::post('/encadrant/rendezvous',                 [RendezvousController::class, 'store']);
Route::get('/encadrant/rendezvous/{id}',             [RendezvousController::class, 'show']);
Route::put('/encadrant/rendezvous/{id}',             [RendezvousController::class, 'update']);
Route::post('/encadrant/rendezvous/{id}/rapport',    [RendezvousController::class, 'ajouterRapport']);
Route::delete('/encadrant/rendezvous/{id}',          [RendezvousController::class, 'destroy']);


Route::get('/grh/dashboard', [GrhController::class, 'dashboard']);

Route::get('/grh/stagiaires',                      [GrhController::class, 'stagiaires']);
Route::get('/grh/stagiaires/liste',                [GrhController::class, 'listeStagiaires']);
Route::get('/grh/stagiaires/archives',             [GrhController::class, 'listeArchives']);
Route::post('/grh/stagiaires/store',               [GrhController::class, 'storeStagiaire']);
Route::get('/grh/stagiaires/{id}',                 [GrhController::class, 'showStagiaire']);
Route::put('/grh/stagiaires/{id}',                 [GrhController::class, 'updateStagiaire']);
Route::delete('/grh/stagiaires/{id}',              [GrhController::class, 'destroyStagiaire']);
Route::post('/grh/stagiaires/{id}/archiver',       [GrhController::class, 'archiverStagiaire']);
Route::post('/grh/stagiaires/{id}/desarchiver',    [GrhController::class, 'desarchiverStagiaire']);
Route::delete('/grh/stagiaires/{id}/force-delete', [GrhController::class, 'forceDeleteStagiaire']);

Route::get('/grh/sujets', [GrhController::class, 'sujets']);

Route::get('/grh/contrats',                  [GrhController::class, 'contrats']);
Route::post('/grh/contrats',                 [GrhController::class, 'storeContrat']);
Route::post('/grh/contrats/{id}/valider',    [GrhController::class, 'validerContrat']);
Route::post('/grh/contrats/{id}/refuser',    [GrhController::class, 'refuserContrat']);
Route::post('/grh/contrats/{id}/pdf',        [GrhController::class, 'importerPdf']);
Route::get('/grh/contrats/{id}/convention-pdf', [GrhController::class, 'conventionPdf']);

Route::get('/grh/autorisations',               [GrhController::class, 'autorisations']);
Route::get('/grh/autorisations/liste',         [GrhController::class, 'listeAutorisations']);
Route::post('/grh/autorisations',              [GrhController::class, 'storeAutorisation']);
Route::delete('/grh/autorisations/{id}',       [GrhController::class, 'destroyAutorisation']);
Route::get('/grh/autorisations/{id}/imprimer', [GrhController::class, 'imprimerAutorisation']);

Route::get('/grh/contrats/liste', [GrhController::class, 'listeContrats']);
Route::delete('/grh/contrats/{id}', [GrhController::class, 'destroyContrat']);
Route::post('/grh/contrats/store-multiple', [GrhController::class, 'storeMultipleContrats']);
