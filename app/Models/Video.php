<?php

namespace App\Models;

use App\Models\Commentaire;
use App\Models\Typeappareil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    public function typeappareil(){
        return $this->belongsTo(Typeappareil::class); 
    }

    public function commentaires(){
        return $this->hasMany(Commentaire::class); 
    }
}
