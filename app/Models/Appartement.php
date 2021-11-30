<?php

namespace App\Models;

use App\Models\Piece;
use App\Models\Maison;
use App\Models\Securite;
use App\Models\Locataire;
use App\Models\Typeappartement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appartement extends Model
{
    use HasFactory;

    public function locataires(){
        return $this->hasMany(Locataire::class); 
    }

    public function maison(){
        return $this->belongsTo(Maison::class); 
    }

    public function typeappartement(){
        return $this->belongsTo(Typeappartement::class); 
    }

    public function pieces(){
        return $this->hasMany(Piece::class); 
    }

    public function securite(){
        return $this->belongsTo(Securite::class); 
    }

}
