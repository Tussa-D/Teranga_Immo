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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date_publication'); // La date de publication
            $table->text('description'); // Description de l'annonce
            $table->string('image')->nullable();
             // Colonne pour stocker le chemin de l'image (peut être NULL)
             $table->string('video')->nullable();
            $table->foreignId('bien_id')
                ->constrained('bien_immobilier')
                ->onDelete('cascade') // Supprimer les annonces si le bien est supprimé
                ->onUpdate('cascade'); // Mettre à jour les clés étrangères si l'id du bien change
            $table->foreignId('proprietaire_id')
                ->constrained('utilisateurs')
                ->onDelete('cascade') // Supprimer les annonces si l'utilisateur est supprimé
                ->onUpdate('cascade'); // Mettre à jour les clés étrangères si l'id de l'utilisateur change
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
