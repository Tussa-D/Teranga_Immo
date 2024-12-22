<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  

            public function up()
            {
                Schema::create('transactions', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('utilisateur_id')->constrained('utilisateurs')->onDelete('cascade');
                    $table->foreignId('annonce_id')->constrained('annonces')->onDelete('cascade');
                    $table->decimal('montant', 10, 2); // Montant payé
                    $table->enum('statut', ['En Attente', 'Payé', 'Annulé'])->default('En Attente'); // Statut du paiement
                    $table->timestamp('date_transaction');
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
