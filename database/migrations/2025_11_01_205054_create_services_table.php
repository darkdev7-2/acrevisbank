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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Multilingue
            $table->json('description')->nullable(); // Multilingue
            $table->json('content')->nullable(); // Multilingue - contenu détaillé
            $table->string('slug')->unique();
            $table->string('type'); // compte, credit, hypotheque, carte, placement, prevoyance, etc.
            $table->string('segment')->default('both'); // privat, entreprise, both
            $table->string('icon')->nullable(); // chemin vers icône ou nom d'icône
            $table->string('image')->nullable(); // image principale
            $table->json('features')->nullable(); // caractéristiques en JSON multilingue
            $table->json('benefits')->nullable(); // avantages en JSON multilingue
            $table->json('conditions')->nullable(); // conditions en JSON multilingue
            $table->string('cta_label')->nullable(); // Label du bouton CTA
            $table->string('cta_link')->nullable(); // Lien du bouton CTA
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
