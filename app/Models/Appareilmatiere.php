<?php

namespace App\Models;

use App\Models\Matiere;
use App\Models\Appareil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appareilmatiere extends Model
{
    use HasFactory;

    public function matiere(){
        return $this->belongsTo(Matiere::class); 
    }

    public function appareil(){
        return $this->belongsTo(Appareil::class); 
    }
}
