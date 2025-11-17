<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CardTransaction extends Model
{
    use LogsActivity;

    protected $fillable = [
        'card_id',
        'transaction_id',
        'type',
        'amount',
        'currency',
        'merchant_name',
        'merchant_category',
        'merchant_city',
        'merchant_country',
        'status',
        'decline_reason',
        'authorization_code',
        'ip_address',
        'is_online',
        'is_international',
        'metadata',
        'authorized_at',
        'settled_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_online' => 'boolean',
            'is_international' => 'boolean',
            'metadata' => 'array',
            'authorized_at' => 'datetime',
            'settled_at' => 'datetime',
        ];
    }

    // Relationships
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeDeclined($query)
    {
        return $query->where('status', 'declined');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Helper methods
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 2, '.', "'") . ' ' . $this->currency;
    }

    public function getMerchantLocationAttribute(): string
    {
        $parts = array_filter([$this->merchant_city, $this->merchant_country]);
        return implode(', ', $parts) ?: 'N/A';
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'approved' => 'success',
            'pending' => 'warning',
            'declined' => 'danger',
            'reversed' => 'info',
            default => 'secondary',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'purchase' => 'Achat',
            'withdrawal' => 'Retrait',
            'refund' => 'Remboursement',
            'fee' => 'Frais',
            'reversal' => 'Annulation',
            default => ucfirst($this->type),
        };
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'amount', 'merchant_name'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Card transaction {$eventName}");
    }
}
