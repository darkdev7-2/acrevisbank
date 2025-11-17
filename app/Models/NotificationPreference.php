<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationPreference extends Model
{
    protected $fillable = [
        'user_id',
        'email_transactions',
        'email_card_activities',
        'email_security_alerts',
        'email_account_updates',
        'email_marketing',
        'email_newsletters',
        'push_transactions',
        'push_card_activities',
        'push_security_alerts',
        'push_account_updates',
        'sms_transactions',
        'sms_security_alerts',
        'sms_otp',
        'transaction_alert_threshold',
        'alert_international_transactions',
        'alert_online_purchases',
        'alert_large_withdrawals',
        'notify_new_messages',
        'notify_message_replies',
        'enable_quiet_hours',
        'quiet_hours_start',
        'quiet_hours_end',
    ];

    protected function casts(): array
    {
        return [
            'email_transactions' => 'boolean',
            'email_card_activities' => 'boolean',
            'email_security_alerts' => 'boolean',
            'email_account_updates' => 'boolean',
            'email_marketing' => 'boolean',
            'email_newsletters' => 'boolean',
            'push_transactions' => 'boolean',
            'push_card_activities' => 'boolean',
            'push_security_alerts' => 'boolean',
            'push_account_updates' => 'boolean',
            'sms_transactions' => 'boolean',
            'sms_security_alerts' => 'boolean',
            'sms_otp' => 'boolean',
            'transaction_alert_threshold' => 'decimal:2',
            'alert_international_transactions' => 'boolean',
            'alert_online_purchases' => 'boolean',
            'alert_large_withdrawals' => 'boolean',
            'notify_new_messages' => 'boolean',
            'notify_message_replies' => 'boolean',
            'enable_quiet_hours' => 'boolean',
        ];
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public function shouldNotifyEmail(string $type): bool
    {
        $field = "email_{$type}";
        return $this->{$field} ?? false;
    }

    public function shouldNotifyPush(string $type): bool
    {
        $field = "push_{$type}";
        return $this->{$field} ?? false;
    }

    public function shouldNotifySms(string $type): bool
    {
        $field = "sms_{$type}";
        return $this->{$field} ?? false;
    }

    public function isInQuietHours(): bool
    {
        if (!$this->enable_quiet_hours || !$this->quiet_hours_start || !$this->quiet_hours_end) {
            return false;
        }

        $now = now()->format('H:i:s');
        $start = $this->quiet_hours_start;
        $end = $this->quiet_hours_end;

        // Handle overnight quiet hours (e.g., 22:00 to 06:00)
        if ($start > $end) {
            return $now >= $start || $now <= $end;
        }

        return $now >= $start && $now <= $end;
    }

    public function shouldAlertForTransaction(float $amount, array $flags = []): bool
    {
        // Check amount threshold
        if ($this->transaction_alert_threshold && $amount > $this->transaction_alert_threshold) {
            return true;
        }

        // Check international transactions
        if ($this->alert_international_transactions && ($flags['is_international'] ?? false)) {
            return true;
        }

        // Check online purchases
        if ($this->alert_online_purchases && ($flags['is_online'] ?? false)) {
            return true;
        }

        // Check large withdrawals
        if ($this->alert_large_withdrawals && ($flags['is_withdrawal'] ?? false) && $amount > 1000) {
            return true;
        }

        return false;
    }

    /**
     * Get or create notification preferences for a user
     */
    public static function getOrCreateForUser(User $user): self
    {
        return self::firstOrCreate(
            ['user_id' => $user->id],
            [
                'email_transactions' => true,
                'email_card_activities' => true,
                'email_security_alerts' => true,
                'email_account_updates' => true,
                'push_transactions' => true,
                'push_security_alerts' => true,
                'sms_security_alerts' => true,
                'alert_international_transactions' => true,
                'alert_large_withdrawals' => true,
                'notify_new_messages' => true,
                'notify_message_replies' => true,
            ]
        );
    }
}
