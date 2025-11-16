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
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g., 'transaction_approved', 'card_blocked'
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('type', ['email', 'sms', 'push', 'message'])->default('email');
            $table->string('subject')->nullable(); // For emails
            $table->text('body'); // Template body with placeholders
            $table->json('placeholders')->nullable(); // Available placeholders
            $table->boolean('is_active')->default(true);
            $table->boolean('is_system')->default(false); // System templates can't be deleted
            $table->string('category')->nullable(); // transaction, security, account, etc.
            $table->timestamps();

            // Indexes
            $table->index('type');
            $table->index('category');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_templates');
    }
};
