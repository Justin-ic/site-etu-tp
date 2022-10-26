<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    public function groupes() {
        return $this->hasMany(Groupe::class,'Salles_id'); // Relation One to Many: filière est le père
    } 

    protected $fillable = ['LibelleSalle'];
}
