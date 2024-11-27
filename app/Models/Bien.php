<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bien extends Model
{
    use HasFactory;

    // Spécifier le nom de la table si différent du nom par défaut
    protected $table = 'bien_immobilier';

    // Spécifier les champs qui peuvent être remplis en masse
    protected $fillable = [
        'titre',
        'description',
        'prix',
        'Nbpiece',
        'adresse',
        'surface',
        'type',
        'video',
        'image',
        'statut',
        'proprietaire_id', 
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'surface' => 'decimal:2',
        'Nbpiece' => 'integer',
        'statut' => 'string',
    ];

    // Relation avec le propriétaire (utilisateur)
    public function proprietaire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'proprietaire_id');
    }

      // Relation entre Bien et Réservation (un bien peut avoir plusieurs réservations)
      public function reservations()
      {
          return $this->hasMany(Reservation::class);  // Le modèle Reservation devra être créé
      }
//    public function annonces(): HasMany
//    {
//        return $this->hasMany(Annonce::class);
//    }
}
