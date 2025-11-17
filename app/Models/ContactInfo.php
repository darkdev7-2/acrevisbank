<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ContactInfo extends Model
{
    use HasTranslations, LogsActivity;

    protected $fillable = [
        'name',
        'type',
        'is_active',
        'order',
        'phone',
        'phone_alt',
        'email',
        'email_alt',
        'whatsapp',
        'fax',
        'address',
        'city',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'opening_hours',
        'description',
        'facebook_url',
        'linkedin_url',
        'twitter_url',
        'instagram_url',
    ];

    public $translatable = [
        'address',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'opening_hours' => 'array',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    /**
     * Get formatted opening hours for display
     */
    public function getFormattedOpeningHoursAttribute(): array
    {
        if (!$this->opening_hours) {
            return [];
        }

        $days = [
            'monday' => __('Lundi'),
            'tuesday' => __('Mardi'),
            'wednesday' => __('Mercredi'),
            'thursday' => __('Jeudi'),
            'friday' => __('Vendredi'),
            'saturday' => __('Samedi'),
            'sunday' => __('Dimanche'),
        ];

        $formatted = [];
        foreach ($days as $key => $label) {
            if (isset($this->opening_hours[$key])) {
                $formatted[$label] = $this->opening_hours[$key];
            }
        }

        return $formatted;
    }

    /**
     * Scope to get only active contacts
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Scope to get by type
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get the main contact info (headquarters)
     */
    public static function getMain(): ?self
    {
        return self::where('type', 'headquarters')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'type', 'phone', 'email', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
