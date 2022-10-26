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

    protected $fillable = ['numeroG', 'Salles_id'];
    
}
