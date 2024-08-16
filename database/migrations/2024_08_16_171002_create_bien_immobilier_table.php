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
        Schema::create('bien_immobilier', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->decimal('prix', 10, 2);
            $table->integer('Nbpiece');
            $table->string('adresse');
            $table->decimal('surface');
            $table->string('type');
            $table->string('video')->nullable(); 
            $table->string('image')->nullable();// Permet l'absence d'image
            $table->enum('statut', ['Disponible', 'Sous Offre', 'Vendu', 'Retiré'])->default('Disponible');
            $table->foreignId('proprietaire_id')
                ->constrained('utilisateurs')
                ->onDelete('cascade') // Supprimer les biens si l'utilisateur est supprimé
                ->onUpdate('cascade'); // Mettre à jour les clés étrangères si l'id de l'utilisateur change
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bien_immobilier');
    }
};
