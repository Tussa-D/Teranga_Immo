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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bien_id')
            ->constrained('bien_immobilier')
            ->onDelete('cascade') // Supprimer les transactions si le bien est supprimé
            ->onUpdate('cascade');
            $table->foreignId('annonce_id')
                ->constrained('annonces')
                ->onDelete('cascade') // Supprimer les transactions si l'annonce est supprimée
                ->onUpdate('cascade'); // Mettre à jour les clés étrangères si l'id de l'annonce change
            $table->foreignId('acheteur_id')
                ->constrained('utilisateurs')
                ->onDelete('cascade') // Supprimer les transactions si l'acheteur est supprimé
                ->onUpdate('cascade'); // Mettre à jour les clés étrangères si l'id de l'acheteur change
            $table->foreignId('vendeur_id')
                ->constrained('utilisateurs')
                ->onDelete('cascade') // Supprimer les transactions si le vendeur est supprimé
                ->onUpdate('cascade'); // Mettre à jour les clés étrangères si l'id du vendeur change
            $table->decimal('montant', 10, 2); // Montant de la transaction
            $table->enum('statut', ['En Attente', 'Complété', 'Annulé'])->default('En Attente'); // Statut de la transaction
            $table->timestamp('date'); // Date de la transaction
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
