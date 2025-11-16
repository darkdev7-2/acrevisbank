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
        Schema::create('card_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->unique(); // Unique transaction reference
            $table->enum('type', ['purchase', 'withdrawal', 'refund', 'fee', 'reversal'])->default('purchase');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('CHF');
            $table->string('merchant_name')->nullable();
            $table->string('merchant_category')->nullable();
            $table->string('merchant_city')->nullable();
            $table->string('merchant_country', 2)->nullable();
            $table->enum('status', ['pending', 'approved', 'declined', 'reversed'])->default('pending');
            $table->string('decline_reason')->nullable();
            $table->string('authorization_code')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->boolean('is_online')->default(false);
            $table->boolean('is_international')->default(false);
            $table->json('metadata')->nullable(); // Additional transaction data
            $table->timestamp('authorized_at')->nullable();
            $table->timestamp('settled_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['card_id', 'created_at']);
            $table->index('status');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_transactions');
    }
};
