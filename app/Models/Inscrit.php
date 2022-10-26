<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscrit extends Model
{
    use HasFactory;


    /*
    // Un guichet a un et un seul service. Ex: service transaction -> description=[depot, retrait...]
    public function service() {
        return $this->belongsTo(service::class); // Relation One To One fils
    }


    // Un guichet est géer par un et un seul prsonnel
    public function personnel() {
        return $this->belongsTo(personnel::class); // Relation One To One fils
    }


*/

    public function etudiant() {
        return $this->belongsTo(Etudiant::class,'Etudiants_id'); // Relation One to Many: niveau est le fils
    } 

    protected $fillable = ['Etudiants_id', 'AnneeUnivs_id', 'Niveaus_id', 'TPs_id', 'Groupes_id'];
    
}
