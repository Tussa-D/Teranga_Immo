<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    protected $fillable = [
        'date_visite', 'commentaire', 'status', 'bien_id', 'visiteur_id',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'visiteur_id');
    }
}

