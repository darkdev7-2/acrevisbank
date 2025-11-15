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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->string('type'); // debit, credit, transfer
            $table->string('category')->nullable(); // payment, transfer, withdrawal, etc.
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('CHF');
            $table->decimal('balance_after', 15, 2);
            $table->string('recipient_name')->nullable();
            $table->string('recipient_iban')->nullable();
            $table->text('description')->nullable();
            $table->string('reference')->nullable();
            $table->string('status')->default('completed'); // pending, completed, failed
            $table->timestamp('transaction_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
