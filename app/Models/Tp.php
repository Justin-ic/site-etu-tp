<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tp extends Model
{
    use HasFactory;


    public function inscrits() {
        return $this->hasMany(Inscrit::class,'TPs_id'); // Relation One to Many: etudiant est le père
        // un étudiant peut s'inscrire dans plusieurs TP
    }
    

    protected $fillable = ['LibelleTp'];
}
