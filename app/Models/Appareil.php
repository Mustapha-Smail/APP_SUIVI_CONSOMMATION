<?php

namespace App\Models;

use App\Models\Piece;
use App\Models\Consommation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appareil extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function piece(){
        return $this->belongsTo(Piece::class); 
    }

    public function typeappareil(){
        return $this->belongsTo(Typeappareil::class); 
    }
    
    public function appareilmatieres(){
        return $this->hasMany(Appareilmatiere::class); 
    }

    public function consommations(){
        return $this->hasMany(Consommation::class); 
    }
}
