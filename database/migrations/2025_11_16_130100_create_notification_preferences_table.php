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
        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Email notifications
            $table->boolean('email_transactions')->default(true);
            $table->boolean('email_card_activities')->default(true);
            $table->boolean('email_security_alerts')->default(true);
            $table->boolean('email_account_updates')->default(true);
            $table->boolean('email_marketing')->default(false);
            $table->boolean('email_newsletters')->default(false);

            // Push notifications (for future implementation)
            $table->boolean('push_transactions')->default(true);
            $table->boolean('push_card_activities')->default(true);
            $table->boolean('push_security_alerts')->default(true);
            $table->boolean('push_account_updates')->default(true);

            // SMS notifications (for future implementation)
            $table->boolean('sms_transactions')->default(false);
            $table->boolean('sms_security_alerts')->default(true);
            $table->boolean('sms_otp')->default(true);

            // Transaction alerts thresholds
            $table->decimal('transaction_alert_threshold', 10, 2)->nullable(); // Alert if transaction > this amount
            $table->boolean('alert_international_transactions')->default(true);
            $table->boolean('alert_online_purchases')->default(false);
            $table->boolean('alert_large_withdrawals')->default(true);

            // Message notifications
            $table->boolean('notify_new_messages')->default(true);
            $table->boolean('notify_message_replies')->default(true);

            // Quiet hours
            $table->boolean('enable_quiet_hours')->default(false);
            $table->time('quiet_hours_start')->nullable();
            $table->time('quiet_hours_end')->nullable();

            $table->timestamps();

            // Unique constraint
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_preferences');
    }
};
