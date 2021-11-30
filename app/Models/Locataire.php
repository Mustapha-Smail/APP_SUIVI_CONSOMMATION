<?php

namespace App\Models;

use App\Models\User;
use App\Models\Appartement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locataire extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class); 
    }

    public function appartement(){
        return $this->belongsTo(Appartement::class); 
    }

}
