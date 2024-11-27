<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // La table associée à ce modèle
    protected $table = 'reservations';

    // Définir les champs pouvant être mass-assigned
    protected $fillable = [
        'bien_id',
        'user_id',
        'reservation_date',
       
    ];

    // Relation entre Reservation et Bien (une réservation appartient à un bien)
    public function bien()
    {
        return $this->belongsTo(Bien::class, 'bien_id');
    }

    // Relation entre Reservation et User (une réservation appartient à un utilisateur)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
