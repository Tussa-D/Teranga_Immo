<?php

namespace App\Models;

use App\Models\Bien;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'email',
        'tel',
        'mot_de_passe',
        'role',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['mot_de_passe'] = bcrypt($password);
    }
    public function biens()
    {
        return $this->hasMany(Bien::class, 'proprietaire_id');
    }
}
