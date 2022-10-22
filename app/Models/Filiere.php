<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;



    public function niveaus() {
        return $this->hasMany(Niveau::class,'Filieres_id'); // Relation One to Many: filière est le père
    } 

    protected $fillable = ['LibelleFiliere'];

}
    


/*    protected $fillable = ['LibelleAnnee'];
    protected $fillable = ['Nom', 'Prenom', 'NCE', 'DateNaissance'];
    protected $fillable = ['LibelleFiliere'];
    protected $fillable = ['LibelleG', 'Salle'];
    protected $fillable = ['Etudiants_id', 'AnneeUnivs_id', 'Niveaus_id', 'TPs_id', 'Groupes_id'];
    protected $fillable = ['LibelleNiveau', 'Filieres_id'];
    protected $fillable = ['Inscrits_id', 'Note', 'Date'];
    protected $fillable = ['LibelleSalle'];
    protected $fillable = ['LibelleTp'];*/
