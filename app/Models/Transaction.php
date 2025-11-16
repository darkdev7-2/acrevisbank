<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Transaction extends Model
{
    use LogsActivity;
    protected $fillable = [
        'account_id',
        'type',
        'category',
        'amount',
        'currency',
        'balance_after',
        'recipient_name',
        'recipient_iban',
        'description',
        'reference',
        'status',
        'transaction_date',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'balance_after' => 'decimal:2',
            'transaction_date' => 'datetime',
        ];
    }

    // Relationships
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    // Helper methods
    public function getFormattedAmountAttribute(): string
    {
        $sign = $this->type === 'debit' ? '-' : '+';
        return $sign . ' ' . number_format($this->amount, 2, '.', "'") . ' ' . $this->currency;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['transaction_number', 'type', 'amount', 'status', 'balance_after'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Transaction {$eventName}");
    }
}
