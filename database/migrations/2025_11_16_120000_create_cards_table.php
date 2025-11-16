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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->string('card_number'); // Encrypted: 16 digits
            $table->string('cvv'); // Encrypted: 3 digits
            $table->string('expiry_month', 2); // MM
            $table->string('expiry_year', 4); // YYYY
            $table->string('cardholder_name');
            $table->string('card_type')->default('Visa'); // Visa, Mastercard, etc.
            $table->enum('status', ['pending', 'active', 'blocked', 'expired', 'cancelled'])->default('pending');
            $table->boolean('is_virtual')->default(true);
            $table->decimal('daily_limit', 10, 2)->default(5000.00);
            $table->decimal('monthly_limit', 10, 2)->default(50000.00);
            $table->decimal('daily_spent', 10, 2)->default(0.00);
            $table->decimal('monthly_spent', 10, 2)->default(0.00);
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->string('blocked_reason')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['account_id', 'status']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
