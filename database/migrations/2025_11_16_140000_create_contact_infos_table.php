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
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nom de l\'entité (ex: Siège Social, Support Client)');
            $table->string('type')->default('general')->comment('Type: general, support, sales, headquarters');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0)->comment('Ordre d\'affichage');

            // Contact details
            $table->string('phone')->nullable();
            $table->string('phone_alt')->nullable()->comment('Téléphone alternatif');
            $table->string('email')->nullable();
            $table->string('email_alt')->nullable()->comment('Email alternatif');
            $table->string('whatsapp')->nullable()->comment('Numéro WhatsApp');
            $table->string('fax')->nullable();

            // Address
            $table->json('address')->nullable()->comment('Adresse (translatable)');
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('Switzerland');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Opening hours
            $table->json('opening_hours')->nullable()->comment('Horaires d\'ouverture par jour');
            $table->json('description')->nullable()->comment('Description (translatable)');

            // Social media
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();

            $table->timestamps();

            $table->index(['is_active', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
