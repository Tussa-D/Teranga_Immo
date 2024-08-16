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
        Schema::create('visites', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date_visite'); // Date et heure de la visite
            $table->text('commentaire'); // Commentaires sur la visite
            $table->enum('status', ['Programmé', 'Effectué', 'Annulé'])->default('Programmé'); // Statut de la visite
            $table->foreignId('bien_id')
                ->constrained('bien_immobilier')
                ->onDelete('cascade') // Supprimer les visites si le bien est supprimé
                ->onUpdate('cascade'); // Mettre à jour les clés étrangères si l'id du bien change
            $table->foreignId('visiteur_id')
                ->constrained('utilisateurs')
                ->onDelete('cascade') // Supprimer les visites si l'utilisateur est supprimé
                ->onUpdate('cascade'); // Mettre à jour les clés étrangères si l'id du visiteur change
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};
