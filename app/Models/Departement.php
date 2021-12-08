<?php

namespace App\Models;

use App\Models\Ville;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function region()
    {
        return $this->belongsTo(Region::class); 
    }

    public function villes()
    {
        return $this->hasMany(Ville::class); 
    }
}
