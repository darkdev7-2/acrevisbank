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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nom du bénéficiaire
            $table->string('iban'); // IBAN du bénéficiaire
            $table->string('bank_name')->nullable(); // Nom de la banque (optionnel)
            $table->string('category')->nullable(); // Catégorie (Famille, Fournisseur, etc.)
            $table->text('notes')->nullable(); // Notes personnelles
            $table->boolean('is_favorite')->default(false); // Épingler en favoris
            $table->timestamps();

            // Index pour performance
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
