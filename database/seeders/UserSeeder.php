<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'nom' => 'John', // nom au lieu de 'name'
            'prenom' => 'Doe', // prénom
            'adresse' => '123 Rue Exemple', // adresse
            'email' => 'admin@example.com',
            'tel' => '774567890', // téléphone
            'mot_de_passe' => bcrypt('passer'), // mot de passe
            'role' => 'admin', // Ou 'client', selon votre logique
        ]);

        User::create([
            'nom' => 'Jane', 
            'prenom' => 'Smith',
            'adresse' => '456 Avenue Exemple',
            'email' => 'proprietaire@example.com',
            'tel' => '777654321',
            'mot_de_passe' => bcrypt('passer'),
            'role' => 'client',
        ]);

        User::create([
            'nom' => 'Michael', 
            'prenom' => 'Johnson',
            'adresse' => '789 Boulevard Exemple',
            'email' => 'client3@example.com',
            'tel' => '772334455',
            'mot_de_passe' => bcrypt('passer'),
            'role' => 'proprietaire',
        ]);

        User::create([
            'nom' => 'Emily', 
            'prenom' => 'Davis',
            'adresse' => '101 Rue Test',
            'email' => 'client2@example.com',
            'tel' => '776778899',
            'mot_de_passe' => bcrypt('passer'),
            'role' => 'client',
        ]);

        User::create([
            'nom' => 'David', 
            'prenom' => 'Wilson',
            'adresse' => '202 Avenue Exemple',
            'email' => 'client1@example.com',
            'tel' => '777889900',
            'mot_de_passe' => bcrypt('passer'),
            'role' => 'proprietaire',
        ]);
    }
}
