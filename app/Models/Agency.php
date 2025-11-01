<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Agency extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'address',
        'city',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'phone',
        'email',
        'opening_hours',
        'description',
        'is_active',
    ];

    public $translatable = [
        'name',
        'address',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'opening_hours' => 'array',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'is_active' => 'boolean',
        ];
    }
}
