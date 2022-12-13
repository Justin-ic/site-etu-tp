<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presence extends Model
{
    use HasFactory;

    public function inscrit()
    {
        return $this->belongsTo(Inscrit::class,"inscrit_id"); // Relation One to Many: Presence est le fils. Un inscrit a plusieurs présence mais une présence, c'est pour un seul inscrit
    }

    protected $fillable = ['Inscrits_id', 'etat'];
    
}
