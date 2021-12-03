<?php

namespace App\Models;

use App\Models\Ville;
use App\Models\Isolation;
use App\Models\Appartement;
use App\Models\Proprietaire;
use App\Models\Statusecologique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maison extends Model
{
    use HasFactory;
    protected $guarded = [];

    // protected $fillable = [
    //     'name', 
    //     'adresse_id'
    // ];

    public function ville()
    {
        return $this->belongsTo(Ville::class) ;
    }

    public function isolation(){
        return $this->belongsTo(Isolation::class); 
    }

    public function statusecologique(){
        return $this->belongsTo(Statusecologique::class); 
    }

    public function appartements(){
        return $this->hasMany(Appartement::class); 
    }

    public function proprietaires(){
        return $this->hasMany(Proprietaire::class); 
    }
}
