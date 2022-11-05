<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;


    public function inscrit() {
        return $this->belongsTo(Inscrit::class,'Inscrits_id'); // Relation One to Many: niveau est le fils et filière le père
    } 

    protected $fillable = ['Inscrits_id', 'Note', 'Date'];
}
