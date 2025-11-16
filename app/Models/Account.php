<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Account extends Model
{
    use LogsActivity;
    protected $fillable = [
        'user_id',
        'account_number',
        'iban',
        'account_type',
        'currency',
        'balance',
        'available_balance',
        'is_active',
        'opened_at',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2',
            'available_balance' => 'decimal:2',
            'is_active' => 'boolean',
            'opened_at' => 'datetime',
        ];
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    // Helper methods
    public function getFormattedIbanAttribute(): string
    {
        // Format IBAN with spaces: CH12 3456 7890 1234 5678 9
        return chunk_split($this->iban, 4, ' ');
    }

    public function getFormattedBalanceAttribute(): string
    {
        return number_format($this->balance, 2, '.', "'") . ' ' . $this->currency;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['account_number', 'iban', 'balance', 'available_balance', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Account {$eventName}");
    }
}
