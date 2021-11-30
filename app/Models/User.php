<?php

namespace App\Models;

use App\Models\Adresse;
use App\Models\Locataire;
use App\Models\Commentaire;
use App\Models\Proprietaire;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nom',
        'email',
        'password',
        'identifiant',
        'prenom',
        'date_naissance',
        'genre',
        'num_tel',
        'adresse_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function proprietaires(){
        return $this->hasMany(Proprietaire::class); 
    }

    public function locataires(){
        return $this->hasMany(Locataire::class); 
    }

    public function commentaires(){
        return $this->hasMany(Commentaire::class); 
    }

    // LIKE DISLIKE VUE A REVOIR 
    
}