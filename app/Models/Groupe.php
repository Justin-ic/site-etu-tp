<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    public function salle() {
        return $this->belongsTo(Salle::class,'Salles_id'); // Relation One to Many: niveau est le fils
    } 


    public function inscrits() {
        return $this->hasMany(Inscrit::class,'Groupes_id'); // Relation One to Many: etudiant est le père
        // un étudiant peut s'inscrire dans plusieurs TP
    }
    
    protected $fillable = ['numeroG', 'Salles_id']; 
    
}
