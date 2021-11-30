<?php

namespace App\Models;

use App\Models\Piece;
use App\Models\Consommation;
use App\Models\Typeappartement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appareil extends Model
{
    use HasFactory;

    public function piece(){
        return $this->belongsTo(Piece::class); 
    }

    public function typeappareil(){
        return $this->belongsTo(Typeappartement::class); 
    }

    public function consommations(){
        return $this->hasMany(Consommation::class); 
    }
}
