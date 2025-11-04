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
        Schema::table('users', function (Blueprint $table) {
            // Informations personnelles KYC
            $table->string('birth_place')->nullable()->after('birth_date');
            $table->string('nationality')->nullable()->after('birth_place');
            $table->string('postal_code', 10)->nullable()->after('city');
            $table->string('street')->nullable()->after('postal_code');

            // Informations professionnelles (Anti-blanchiment)
            $table->string('profession')->nullable()->after('nationality');
            $table->string('employer')->nullable()->after('profession');
            $table->decimal('annual_income', 12, 2)->nullable()->after('employer');
            $table->string('funds_source')->nullable()->after('annual_income'); // Salaire, Épargne, Héritage, etc.

            // Documents d'identité
            $table->string('id_document_type')->nullable()->after('funds_source'); // passport, id_card, residence_permit
            $table->string('id_document_number')->nullable()->after('id_document_type');
            $table->string('id_document_path')->nullable()->after('id_document_number'); // Chemin vers le fichier uploadé
            $table->date('id_document_expiry')->nullable()->after('id_document_path');

            // Statut de validation (Conformité bancaire)
            $table->enum('validation_status', ['pending', 'validated', 'rejected'])->default('pending')->after('is_active');
            $table->timestamp('validated_at')->nullable()->after('validation_status');
            $table->foreignId('validated_by')->nullable()->constrained('users')->after('validated_at'); // L'admin qui a validé
            $table->text('rejection_reason')->nullable()->after('validated_by');

            // Conformité LBA (Loi sur le blanchiment d'argent)
            $table->boolean('politically_exposed')->default(false)->after('rejection_reason'); // Personne politiquement exposée
            $table->string('tax_residence_country')->nullable()->after('politically_exposed'); // Pays de résidence fiscale
            $table->string('tax_identification_number')->nullable()->after('tax_residence_country'); // Numéro d'identification fiscale

            // Consentements RGPD/LPD
            $table->boolean('terms_accepted')->default(false)->after('tax_identification_number');
            $table->timestamp('terms_accepted_at')->nullable()->after('terms_accepted');
            $table->boolean('marketing_consent')->default(false)->after('terms_accepted_at');
            $table->timestamp('marketing_consent_at')->nullable()->after('marketing_consent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['validated_by']);
            $table->dropColumn([
                'birth_place',
                'nationality',
                'postal_code',
                'street',
                'profession',
                'employer',
                'annual_income',
                'funds_source',
                'id_document_type',
                'id_document_number',
                'id_document_path',
                'id_document_expiry',
                'validation_status',
                'validated_at',
                'validated_by',
                'rejection_reason',
                'politically_exposed',
                'tax_residence_country',
                'tax_identification_number',
                'terms_accepted',
                'terms_accepted_at',
                'marketing_consent',
                'marketing_consent_at',
            ]);
        });
    }
};
