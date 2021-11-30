<?php

namespace App\Models;

use App\Models\Maison;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statusecologique extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle'
    ];

    public function maisons(){
        return $this->hasMany(Maison::class); 
    }

}
