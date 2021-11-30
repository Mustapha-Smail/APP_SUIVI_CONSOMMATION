<?php

namespace App\Models;

use App\Models\Typepiece;
use App\Models\Typeappartement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Convention extends Model
{
    use HasFactory;

    public function typeappartement(){
        return $this->belongsTo(Typeappartement::class); 
    }

    public function typepiece(){
        return $this->belongsTo(Typepiece::class); 
    }
}
