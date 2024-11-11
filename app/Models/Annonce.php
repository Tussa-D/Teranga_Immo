<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Annonce extends Model
{
    use HasFactory;

    // Spécifier le nom de la table
    protected $table = 'annonces';

    // Spécifier les champs
    protected $fillable = [
        'date_publication',
        'description',
        'image',
        'titre',
        'image',  'video',
        'statut',
        'bien_id',
        'proprietaire_id',
    ];

    // Définir les relations avec les autres modèles
    public function bien(): BelongsTo
    {
        return $this->belongsTo(Bien::class);
    }

    public function proprietaire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'proprietaire_id');
    }

     // Relation avec Pack
     public function pack()
     {
         return $this->belongsTo(Pack::class);
     }
}
