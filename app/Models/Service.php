<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;

class Service extends Model
{
    use HasTranslations, Searchable;

    protected $fillable = [
        'title',
        'description',
        'content',
        'slug',
        'type',
        'segment',
        'icon',
        'image',
        'features',
        'benefits',
        'conditions',
        'cta_label',
        'cta_link',
        'is_featured',
        'is_active',
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
            'is_active' => 'boolean',
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'content' => $this->getTranslations('content'),
            'type' => $this->type,
            'segment' => $this->segment,
        ];
    }
}
