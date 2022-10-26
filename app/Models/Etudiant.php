<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;


    public function inscrits() {
        return $this->hasMany(Inscrit::class,'Etudiants_id'); // Relation One to Many: etudiant est le père
        // un étudiant peut s'inscrire dans plusieurs TP
    } 

    protected $fillable = ['Nom', 'Prenom', 'NCE', 'DateNaissance', 'email', 'password'];
}
