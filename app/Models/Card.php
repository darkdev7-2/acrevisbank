<?php

namespace App\Models;

use App\Traits\HasEncryptedAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Card extends Model
{
    use LogsActivity, SoftDeletes, HasEncryptedAttributes;

    protected $fillable = [
        'account_id',
        'card_number',
        'cvv',
        'expiry_month',
        'expiry_year',
        'cardholder_name',
        'card_type',
        'status',
        'is_virtual',
        'daily_limit',
        'monthly_limit',
        'daily_spent',
        'monthly_spent',
        'activated_at',
        'blocked_at',
        'blocked_reason',
        'last_used_at',
    ];

    protected $hidden = [
        'card_number',
        'cvv',
    ];

    protected function casts(): array
    {
        return [
            'is_virtual' => 'boolean',
            'daily_limit' => 'decimal:2',
            'monthly_limit' => 'decimal:2',
            'daily_spent' => 'decimal:2',
            'monthly_spent' => 'decimal:2',
            'activated_at' => 'datetime',
            'blocked_at' => 'datetime',
            'last_used_at' => 'datetime',
        ];
    }

    /**
     * Attributes to encrypt
     */
    protected function encryptedAttributes(): array
    {
        return [
            'card_number',
            'cvv',
        ];
    }

    // Relationships
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(CardTransaction::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeBlocked($query)
    {
        return $query->where('status', 'blocked');
    }

    public function scopeVirtual($query)
    {
        return $query->where('is_virtual', true);
    }

    // Helper methods
    public function getMaskedCardNumberAttribute(): string
    {
        $number = $this->card_number;
        if (strlen($number) !== 16) {
            return '•••• •••• •••• ••••';
        }

        // Show only last 4 digits: •••• •••• •••• 1234
        return '•••• •••• •••• ' . substr($number, -4);
    }

    public function getFormattedCardNumberAttribute(): string
    {
        $number = $this->card_number;
        if (strlen($number) !== 16) {
            return $number;
        }

        // Format: 1234 5678 9012 3456
        return implode(' ', str_split($number, 4));
    }

    public function getExpiryDateAttribute(): string
    {
        return sprintf('%s/%s', $this->expiry_month, substr($this->expiry_year, -2));
    }

    public function getIsExpiredAttribute(): bool
    {
        $expiryDate = \Carbon\Carbon::createFromDate($this->expiry_year, $this->expiry_month, 1)->endOfMonth();
        return now()->isAfter($expiryDate);
    }

    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'active' && !$this->is_expired;
    }

    public function canTransact(float $amount): bool
    {
        if (!$this->is_active) {
            return false;
        }

        // Check daily limit
        if (($this->daily_spent + $amount) > $this->daily_limit) {
            return false;
        }

        // Check monthly limit
        if (($this->monthly_spent + $amount) > $this->monthly_limit) {
            return false;
        }

        // Check account balance
        if ($this->account->available_balance < $amount) {
            return false;
        }

        return true;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'daily_limit', 'monthly_limit', 'blocked_reason'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Card {$eventName}");
    }
}
