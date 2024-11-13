<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('annonces', function (Blueprint $table) {
            
        // Modifier la colonne 'statut' pour corriger la valeur 'En cour' en 'En cours'
        Schema::table('annonces', function (Blueprint $table) {
            $table->enum('statut', ['En cours', 'Active', 'Suspended', 'Expired', 'Archived'])->default('En cours')->change();
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annonces', function (Blueprint $table) {
            // Si vous voulez annuler cette migration, remettez l'espace dans 'En cour'
        Schema::table('annonces', function (Blueprint $table) {
            $table->enum('statut', ['En cour', 'Active', 'Suspended', 'Expired', 'Archived'])->default('En cour')->change();
        });
        });
    }
};
