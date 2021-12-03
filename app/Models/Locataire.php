<?php

namespace App\Models;

use App\Models\User;
use App\Models\Appartement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locataire extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'user_id',
    //     'appartement_id',
    //     'debut_location',
    //     'fin_location',
    //     'created_at',
    //     'updated_at',

    // ];
    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class); 
    }

    public function appartement(){
        return $this->belongsTo(Appartement::class); 
    }

}
