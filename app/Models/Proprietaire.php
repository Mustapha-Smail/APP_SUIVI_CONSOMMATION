<?php

namespace App\Models;

use App\Models\User;
use App\Models\Maison;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proprietaire extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class); 
    }

    public function maison(){
        return $this->belongsTo(Maison::class); 
    }
}