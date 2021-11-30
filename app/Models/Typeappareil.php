<?php

namespace App\Models;

use App\Models\Video;
use App\Models\Appareil;
use App\Models\Appareilmatiere;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Typeappareil extends Model
{
    use HasFactory;

    public function appareils(){
        return $this->hasMany(Appareil::class); 
    }

    public function appareilmatieres(){
        return $this->hasMany(Appareilmatiere::class); 
    }

    public function videos(){
        return $this->hasMany(Video::class); 
    }
}
