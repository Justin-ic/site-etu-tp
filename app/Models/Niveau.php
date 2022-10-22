<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
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

    public function filiere() {
        return $this->belongsTo(Filiere::class,'Filieres_id'); // Relation One to Many: niveau est le fils
    } 

    // Relation One To MAny: un niveau (L1) est lié à une seule filière. une filière est liée à +s niveaux
    // Niveau est le fils; il prend le id du père
    protected $fillable = ['LibelleNiveau', 'Filieres_id'];
}
