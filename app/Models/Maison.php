<?php

namespace App\Models;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maison extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'adresse_id'
    ];

    public function ville()
    {
        return $this->belongsTo(Ville::class) ;
    }
}
