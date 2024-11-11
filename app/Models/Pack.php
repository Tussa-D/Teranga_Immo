<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prix', 'nombre_annonces','description','duree'
    ];

    // Relation avec les annonces
    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }
}

