<?php

namespace App\Models;

use App\Models\Maison;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code_postal', 
        'departement_id'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class); 
    }

    public function maisons()
    {
        return $this->hasMany(Maison::class); 
    }
}
