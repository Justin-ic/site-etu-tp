<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\InscritsController;
use App\Http\Controllers\AnneeUnivsController;
use App\Http\Controllers\FilieresController;
use App\Http\Controllers\NiveausController;
use App\Http\Controllers\TPsController;
// use PDF;
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
    return view('connexion');
});

Route::get('admin', function () {
    // S'il y a deja un admin, on passe directement à l'accueil
    return view('connec_admin');
})->name('admin');

Route::get('accueil', function () {
    return view('accueil');
})->name('accueil');


                //     LES ACTIONS

/*****************************clients************************************/
Route::resource('config', AdminController::class); 
Route::post('config/login', [AdminController::class,'loginAdmin'])->name('loginAdmin'); 
Route::post('login', [EtudiantController::class,'loginEtu'])->name('loginEtu'); 



/***********************Gestion des tableaux éditables*****************************/
Route::post('config/tabledit_anne', [AnneeUnivsController::class,'action'])->name('tabledit_anne'); 
Route::post('config/tabledit_filiere', [FilieresController::class,'action'])->name('tabledit_filiere'); 
Route::post('config/tabledit_niveau', [NiveausController::class,'action'])->name('tabledit_niveau'); 
Route::post('config/tabledit_Tps', [TPsController::class,'action'])->name('tabledit_Tp'); 


/***********************Gestion des tableaux éditables*****************************/




Route::resource('etudiant', EtudiantController::class); 
// Dans ce cas, nous même, on ne nomme pas les routes car la nomination est faite automatiquement 

Route::post('etudiant/Store_etudiant', [EtudiantController::class,'store'])->name('Store_etudiant'); 

Route::post('etudiant/update_etudiant/{id}', [EtudiantController::class,'update'])->name('update_etudiant'); 
Route::get('clients/destroy_etudiant/{id}', [EtudiantController::class,'destroy'])->name('destroy_etudiant'); 



Route::resource('inscrits', InscritsController::class); 
// Dans ce cas, nous même, on ne nomme pas les routes car la nomination est faite automatiquement 

Route::post('inscrits/update_inscrits/{id}', [InscritsController::class,'update'])->name('update_inscrits'); 
Route::get('clients/destroy_inscrits/{id}', [InscritsController::class,'destroy'])->name('destroy_inscrits'); 




Route::resource('annee_univs', AnneeUnivsController::class); 

// Route::post('annee_univs/update/{id}', [AnneeUnivsController::class,'update'])->name('update_annee_univs'); 
// Route::get('annee_univs/destroy/{id}', [AnneeUnivsController::class,'destroy'])->name('destroy_annee_univs'); 






Route::resource('filieres', FilieresController::class); 

// Route::post('filieres/update/{id}', [FilieresController::class,'update'])->name('update_filieres'); 
// Route::get('filieres/destroy/{id}', [FilieresController::class,'destroy'])->name('destroy_filieres'); 




Route::resource('niveaux', NiveausController::class); 

// Route::post('niveaux/update/{id}', [FilieresController::class,'update'])->name('update_filieres'); 
// Route::get('niveaux/destroy/{id}', [FilieresController::class,'destroy'])->name('destroy_filieres'); 



Route::resource('Tps', TPsController::class); 

// Route::post('niveaux/update/{id}', [FilieresController::class,'update'])->name('update_filieres'); 
// Route::get('niveaux/destroy/{id}', [FilieresController::class,'destroy'])->name('destroy_filieres'); 