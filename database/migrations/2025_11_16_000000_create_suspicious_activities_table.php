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
        Schema::create('suspicious_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type'); // login_attempt, multiple_failures, ip_change, unusual_time, rapid_transactions, etc.
            $table->string('severity')->default('medium'); // low, medium, high, critical
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('location')->nullable(); // Pays/ville si disponible
            $table->json('details')->nullable(); // Détails spécifiques à chaque type
            $table->decimal('risk_score', 5, 2)->default(0); // Score de risque 0-100
            $table->boolean('is_resolved')->default(false);
            $table->foreignId('resolved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('resolved_at')->nullable();
            $table->text('resolution_notes')->nullable();
            $table->boolean('false_positive')->default(false);
            $table->timestamps();

            // Index pour améliorer les performances
            $table->index(['user_id', 'created_at']);
            $table->index(['type', 'severity']);
            $table->index(['is_resolved', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suspicious_activities');
    }
};
