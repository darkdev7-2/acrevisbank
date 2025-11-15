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
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone')->nullable()->after('email');
            $table->string('whatsapp')->nullable()->after('phone');
            $table->string('country')->nullable()->after('whatsapp');
            $table->string('city')->nullable()->after('country');
            $table->text('address')->nullable()->after('city');
            $table->string('preferred_language')->default('fr')->after('address'); // fr, de, en, es
            $table->string('account_type')->default('customer')->after('preferred_language'); // customer, admin, employee
            $table->string('customer_segment')->nullable()->after('account_type'); // privat, entreprise
            $table->date('birth_date')->nullable()->after('customer_segment');
            $table->boolean('is_active')->default(true)->after('birth_date');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'last_name', 'phone', 'whatsapp', 'country',
                'city', 'address', 'preferred_language', 'account_type',
                'customer_segment', 'birth_date', 'is_active', 'last_login_at'
            ]);
        });
    }
};
