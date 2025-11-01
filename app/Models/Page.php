<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;

class Page extends Model
{
    use HasTranslations, Searchable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'template',
        'meta_title',
        'meta_description',
        'is_published',
        'show_in_menu',
        'menu_order',
    ];

    public $translatable = [
        'title',
        'content',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'show_in_menu' => 'boolean',
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'content' => $this->getTranslations('content'),
        ];
    }
}
