<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditRequest extends Model
{
    protected $fillable = [
        'user_id',
        'reference_number',
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'nationality',
        'marital_status',
        'profession',
        'country',
        'city',
        'address',
        'email',
        'phone',
        'whatsapp',
        'amount',
        'currency',
        'duration_months',
        'purpose',
        'has_other_credit',
        'other_credit_details',
        'attachment_path',
        'status',
        'admin_notes',
        'reviewed_at',
        'reviewed_by',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'amount' => 'decimal:2',
            'has_other_credit' => 'boolean',
            'reviewed_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
