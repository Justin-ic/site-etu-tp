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
        return $this->belongsTo(Etudiant::class,'Etudiants_id'); // Relation One to Many: inscrit est le fils: il prend le nom de son papa
    } 


    public function niveau() {
        return $this->belongsTo(Niveau::class,'Niveaus_id'); // Relation One to Many: inscrit est le fils
    } 


    public function Tp() {
        return $this->belongsTo(Tp::class,'TPs_id'); // Relation One to Many: inscrit est le fils
    } 


    public function groupe() {
        return $this->belongsTo(Groupe::class,'Groupes_id'); // Relation One to Many: inscrit est le fils
    } 



    public function notes() {
        return $this->hasMany(Note::class,'Inscrits_id'); // Relation One to Many: inscrit est le père
    } 
    

    public function presences(){ // Relation One to Many: Presence est le fils. Un inscrit a plusieurs présence mais une présence, c'est pour un seul inscrit
        return $this->hasMany(presence::class,'Inscrits_id');
    }

    protected $fillable = ['Etudiants_id', 'AnneeUnivs_id', 'Niveaus_id', 'TPs_id', 'Groupes_id'];
    
}
