<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;


    public function inscrit() {
        return $this->belongsTo(Inscrit::class,'Inscrits_id'); // Relation One to Many: note est le fils et inscrit le père
    } 

    protected $fillable = ['Inscrits_id', 'Note'];
}
