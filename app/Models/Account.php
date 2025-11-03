<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
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
}
