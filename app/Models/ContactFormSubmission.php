<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactFormSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'type',
        'preferred_contact_method',
        'preferred_date',
        'preferred_time',
        'status',
        'admin_response',
        'replied_at',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'preferred_date' => 'date',
            'replied_at' => 'datetime',
        ];
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeProcessed($query)
    {
        return $query->where('status', 'processed');
    }
}
