<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Career extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'location',
        'department',
        'contract_type',
        'workload',
        'description',
        'requirements',
        'benefits',
        'published_at',
        'expires_at',
        'is_active',
        'order',
    ];

    public $translatable = [
        'title',
        'description',
        'requirements',
        'benefits',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'expires_at' => 'date',
            'is_active' => 'boolean',
        ];
    }

    // Scope for active jobs
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', now());
            });
    }
}
