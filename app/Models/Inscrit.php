<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscrit extends Model
{
    use HasFactory;
    protected $fillable = ['Etudiants_id', 'AnneeUnivs_id', 'Niveaus_id', 'TPs_id', 'Groupes_id'];
    
}
