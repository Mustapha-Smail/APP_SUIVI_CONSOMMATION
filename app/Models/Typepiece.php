<?php

namespace App\Models;

use App\Models\Piece;
use App\Models\Convention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Typepiece extends Model
{
    use HasFactory;

    public function conventions(){
        return $this->hasMany(Convention::class); 
    }

    public function pieces(){
        return $this->hasMany(Piece::class); 
    }
}
