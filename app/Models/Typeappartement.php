<?php

namespace App\Models;

use App\Models\Convention;
use App\Models\Appartement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Typeappartement extends Model
{
    use HasFactory;

    public function appartements(){
        return $this->hasMany(Appartement::class);
    }

    public function conventions(){
        return $this->hasMany(Convention::class); 
    }

}
