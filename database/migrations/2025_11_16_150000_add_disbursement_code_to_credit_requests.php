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
        Schema::table('credit_requests', function (Blueprint $table) {
            // Code de déboursement généré
            $table->string('disbursement_code', 8)->nullable()->after('status');

            // Date de génération du code
            $table->timestamp('disbursement_code_generated_at')->nullable()->after('disbursement_code');

            // Statut du déboursement
            // null = pas encore généré
            // 'code_generated' = code généré, en attente de validation
            // 'validated' = code validé, compte crédité
            // 'expired' = code expiré (après 24h par exemple)
            $table->string('disbursement_status')->nullable()->after('disbursement_code_generated_at');

            // ID du compte bancaire à créditer
            $table->unsignedBigInteger('account_id')->nullable()->after('disbursement_status');

            // Date effective du crédit du compte
            $table->timestamp('disbursed_at')->nullable()->after('account_id');

            // Index pour performance
            $table->index('disbursement_code');
            $table->index('disbursement_status');

            // Foreign key vers accounts
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('credit_requests', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropIndex(['disbursement_code']);
            $table->dropIndex(['disbursement_status']);
            $table->dropColumn([
                'disbursement_code',
                'disbursement_code_generated_at',
                'disbursement_status',
                'account_id',
                'disbursed_at'
            ]);
        });
    }
};
