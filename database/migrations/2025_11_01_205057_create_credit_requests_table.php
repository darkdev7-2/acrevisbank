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
        Schema::create('credit_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Informations personnelles
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender')->nullable(); // M, F, Other
            $table->date('birth_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable(); // single, married, divorced, widowed, partnership

            // Informations professionnelles
            $table->string('profession')->nullable();

            // Coordonnées
            $table->string('country');
            $table->string('city');
            $table->text('address');
            $table->string('email');
            $table->string('phone');
            $table->string('whatsapp')->nullable();

            // Détails du crédit
            $table->decimal('amount', 15, 2); // Montant demandé
            $table->string('currency')->default('CHF');
            $table->integer('duration_months'); // Durée en mois
            $table->text('purpose'); // Motif du crédit
            $table->boolean('has_other_credit')->default(false); // A déjà un autre crédit?
            $table->text('other_credit_details')->nullable();

            // Documents
            $table->string('attachment_path')->nullable(); // Justificatif

            // Statut
            $table->string('status')->default('pending'); // pending, in_review, approved, rejected
            $table->text('admin_notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_requests');
    }
};
