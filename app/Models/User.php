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

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'identifiant',
        'nom',
        'prenom',
        'date_naissance',
        'genre',
        'email',
        'password',
        'num_tel',
        'created_at',
        'updated_at',
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

    protected $dates = [
        'date_naissance',
        'created_at',
        'expired_at',
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
