<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Beneficiary extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'iban',
        'bank_name',
        'category',
        'notes',
        'is_favorite',
    ];

    protected function casts(): array
    {
        return [
            'is_favorite' => 'boolean',
        ];
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public function getFormattedIbanAttribute(): string
    {
        // Format IBAN with spaces: CH12 3456 7890 1234 5678 9
        return chunk_split($this->iban, 4, ' ');
    }
}
