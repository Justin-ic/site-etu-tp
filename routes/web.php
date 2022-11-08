<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\InscritsController;
use App\Http\Controllers\AnneeUnivsController;
use App\Http\Controllers\FilieresController;
use App\Http\Controllers\NiveausController;
use App\Http\Controllers\TPsController;
use App\Http\Controllers\SallesController;
use App\Http\Controllers\GroupesController;
use App\Http\Controllers\NotesController; 
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
    if (!isset($_SESSION)) { session_start(); }
    session_destroy();
    return view('connexion');
})->name('connexion');

Route::get('admin', function () {
    // S'il y a deja un admin, on passe directement à l'accueil
     if (!isset($_SESSION)) { session_start(); }
    session_destroy();
    // if (isset($_SESSION)) { dd('Session existe je detruit'); session_destroy(); }
    return view('connec_admin');
})->name('admin');



                //     LES ACTIONS

/*****************************clients************************************/
Route::get('accueil', [EtudiantController::class,'accueil'])->name('accueil'); 


Route::resource('config', AdminController::class); 
Route::post('config/profil', [AdminController::class,'update'])->name('updateAdmin'); 
Route::post('config/login', [AdminController::class,'loginAdmin'])->name('loginAdmin'); 
Route::post('login', [EtudiantController::class,'loginEtu'])->name('loginEtu'); 

Route::get('monProfil', [AdminController::class,'profil'])->name('monProf'); 


/***********************Gestion des tableaux éditables*****************************/
Route::post('config/tabledit_anne', [AnneeUnivsController::class,'action'])->name('tabledit_anne'); 
Route::post('config/tabledit_filiere', [FilieresController::class,'action'])->name('tabledit_filiere'); 
Route::post('config/tabledit_niveau', [NiveausController::class,'action'])->name('tabledit_niveau'); 
Route::post('config/tabledit_Tps', [TPsController::class,'action'])->name('tabledit_Tp'); 
Route::post('config/tabledit_Salle', [SallesController::class,'action'])->name('tabledit_Salle'); 
Route::post('config/tabledit_Groupe', [GroupesController::class,'action'])->name('tabledit_Groupe'); 
Route::post('config/tabledit_Notes', [NotesController::class,'action'])->name('tabledit_Notes'); 


/***********************Gestion des tableaux éditables*****************************/




Route::resource('etudiant', EtudiantController::class); 
// Dans ce cas, nous même, on ne nomme pas les routes car la nomination est faite automatiquement 

Route::post('etudiant/Store_etudiant', [EtudiantController::class,'store'])->name('Store_etudiant'); 

Route::post('etudiant/update_etudiant', [EtudiantController::class,'update'])->name('update_etudiant'); 

Route::get('clients/destroy_etudiant/{id}', [EtudiantController::class,'destroy'])->name('destroy_etudiant'); 



Route::resource('inscrits', InscritsController::class); 
// Dans ce cas, nous même, on ne nomme pas les routes car la nomination est faite automatiquement 

Route::post('inscrits/update_Niv', [InscritsController::class,'update'])->name('update_InsNiv'); 
Route::post('inscrits/update_TP', [InscritsController::class,'updateTp'])->name('update_InsTP'); 
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

Route::post('infoTP/update', [TPsController::class,'update'])->name('update_TP'); 
// Route::get('niveaux/destroy/{id}', [FilieresController::class,'destroy'])->name('destroy_filieres'); 




Route::resource('configSalleTps', SallesController::class); 

// Route::post('niveaux/update/{id}', [FilieresController::class,'update'])->name('update_filieres'); 
// Route::get('niveaux/destroy/{id}', [FilieresController::class,'destroy'])->name('destroy_filieres'); 






Route::resource('configGroupe', GroupesController::class); 

Route::post('configGr', [AdminController::class,'configGroupes'])->name('configGr'); 
Route::get('configFiltreG/{idNiveau}/{idTP}', [AdminController::class,'configFiltreG'])->name('configFiltreG'); 
// Route::post('niveaux/update/{id}', [FilieresController::class,'update'])->name('update_filieres'); 
// Route::get('niveaux/destroy/{id}', [FilieresController::class,'destroy'])->name('destroy_filieres'); 






// Route::resource('configDetailG/{idNiveau}/{idTP}', AdminController::class); 

Route::get('configDetailG/{idNiveau}/{idTP}', [AdminController::class,'configAfficheDetailG'])->name('configDetailG'); 
// Route::get('niveaux/destroy/{id}', [FilieresController::class,'destroy'])->name('destroy_filieres'); 






// Route::resource('configDetailG/{idNiveau}/{idTP}', AdminController::class); 
/* Pour sortir d'un TP si on n'a pas encore de note*/
Route::get('sortiTP/{idTP}', [InscritsController::class,'sortiTP'])->name('sortiTP'); 
// Route::get('niveaux/destroy/{id}', [FilieresController::class,'destroy'])->name('destroy_filieres'); 




// Route::resource('configDetailG/{idNiveau}/{idTP}', AdminController::class); 
/* Pour sortir d'un TP si on n'a pas encore de note*/
Route::resource('configEval', NotesController::class); 
Route::post('evaluation', [NotesController::class,'evaluation'])->name('evaluation'); 
Route::post('afficheNotes', [NotesController::class,'afficheNotes'])->name('afficheNotes'); 




/*Info github*/
// user=Justin-ic
// Le Mot de passe pour fair un push: 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  


/*

configuration de la base de donnée

postgres:// vwxhztosbfetaw : ed9c3520b8a497508dd19658beb1b926fa94651e6343272e6d1e98a5c3a7f89c @ ec2-34-207-12-160.compute-1.amazonaws.com : 5432 / d7i8keapc7fcia


DB_CONNECTION=pgsql      // car on a utilise postgres 
DB_USERNAME=vwxhztosbfetaw
DB_PASSWORD=ed9c3520b8a497508dd19658beb1b926fa94651e6343272e6d1e98a5c3a7f89c
DB_HOST=ec2-34-207-12-160.compute-1.amazonaws.com 
DB_PORT=5432
DB_DATABASE=d7i8keapc7fcia 











*/