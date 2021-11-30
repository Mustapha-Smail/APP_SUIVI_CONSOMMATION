<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isolation extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle'
    ];

    public function maisons(){
        return $this->hasMany(Maison::class); 
    }
}
