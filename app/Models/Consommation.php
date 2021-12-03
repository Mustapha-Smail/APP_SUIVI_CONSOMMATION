<?php

namespace App\Models;

use App\Models\Matiere;
use App\Models\Appareil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consommation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function appareil(){
        return $this->belongsTo(Appareil::class); 
    }

    public function matiere(){
        return $this->belongsTo(Matiere::class); 
    }
}
