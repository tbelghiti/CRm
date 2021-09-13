<?php

namespace App\Models;

use App\Models\Profil;
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
        'prenom',
        'email',
        'password',
        'poste',
        'naissance',
        'base_salaire',
        'cv',
        'photo',
        'date_recrutement',
        'date_derniere_connexion',
        'lieu_du_travail',
        'contrat',
        'statut',
        'adresse',
        'ville',
        'pays',
        'telephone1',
        'telephone2',
        'note1',
        'note2',
        'profils_id'


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
    public function profile()
    {
        return $this->hasOne(Profil::class);
    }
}
