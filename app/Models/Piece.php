<?php

namespace App\Models;

use App\Models\Appareil;
use App\Models\Typepiece;
use App\Models\Appartement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Piece extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function appartement(){
        return $this->belongsTo(Appartement::class); 
    }

    public function typepiece(){
        return $this->belongsTo(Typepiece::class); 
    }

    public function appareils(){
        return $this->hasMany(Appareil::class); 
    }
}
