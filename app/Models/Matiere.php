<?php

namespace App\Models;

use App\Models\Consommation;
use App\Models\Appareilmatiere;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matiere extends Model
{
    use HasFactory;

    public function consommations(){
        return $this->hasMany(Consommation::class); 
    }

    public function appareilmatieres(){
        return $this->hasMany(Appareilmatiere::class); 
    }
}
