<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Laravel\Scout\Searchable;

class Service extends Model
{
    use LogsActivity;
    use HasTranslations, Searchable;

    protected $fillable = [
        'title',
        'description',
        'content',
        'slug',
        'category',
        'segment',
        'icon',
        'image',
        'features',
        'benefits',
        'conditions',
        'cta_label',
        'cta_link',
        'is_featured',
        'is_published',
        'order',
    ];

    public $translatable = [
        'title',
        'description',
        'content',
        'features',
        'benefits',
        'conditions',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'benefits' => 'array',
            'conditions' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'content' => $this->getTranslations('content'),
            'category' => $this->category,
            'segment' => $this->segment,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'description', 'category', 'segment', 'is_published', 'is_featured'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Scope to only get published services
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
