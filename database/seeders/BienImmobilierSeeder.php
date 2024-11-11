<?php

namespace Database\Seeders;
use App\Models\BienImmobilier; // Ajoutez cette ligne


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Ajoutez cette ligne


class BienImmobilierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        BienImmobilier::create([
            'titre' => 'Appartement à Dakar a louer',
            'description' => 'Appartement de 3 chambres situé en centre-ville.',
            'prix' => 500000,
            'Nbpiece' => 4,
            'adresse' => '10 Rue de george pampidou, viller',
            'surface' => 85,
            'type' => 'Appartement',
            'statut' => 'Disponible',
            'proprietaire_id' => 1, // Assurez-vous que l'utilisateur existe
        ]);

        BienImmobilier::create([
            'titre' => 'Maison à louer Mbour',
            'description' => 'Maison spacieuse avec un grand jardin avec piscine',
            'prix' => 350000,
            'Nbpiece' => 5,
            'adresse' => '45 Rue de niakhniakhal',
            'surface' => 150,
            'type' => 'Maison',
            'statut' => 'Disponible',
            'proprietaire_id' => 2,
        ]);

        BienImmobilier::create([
            'titre' => 'Studio à louer Keur Massar',
            'description' => 'Studio moderne et bien situé.',
            'prix' => 200000,
            'Nbpiece' => 1,
            'adresse' => '22 Rue , a cote du station M3',
            'surface' => 30,
            'type' => 'Studio',
            'statut' => 'Disponible',
            'proprietaire_id' => 3,
        ]);

        BienImmobilier::create([
            'titre' => 'Villa à  vendre Almadie2',
            'description' => 'Villa de luxe avec piscine.',
            'prix' => 1200000,
            'Nbpiece' => 7,
            'adresse' => '88 Rue , cote boulangerie graine d or',
            'surface' => 350,
            'type' => 'Villa',
            'statut' => 'Disponible',
            'proprietaire_id' => 4,
        ]);

        BienImmobilier::create([
            'titre' => 'Appartement à Saint Louis',
            'description' => 'Appartement neuf avec deux chambres.',
            'prix' => 280000,
            'Nbpiece' => 3,
            'adresse' => '15 Rue ',
            'surface' => 60,
            'type' => 'Appartement',
            'statut' => 'Disponible',
            'proprietaire_id' => 5,
        ]);
    }
}
