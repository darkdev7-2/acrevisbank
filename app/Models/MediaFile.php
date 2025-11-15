<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;

class MediaFile extends Model
{
    use HasTranslations, Searchable;

    protected $fillable = [
        'title',
        'description',
        'filename',
        'path',
        'type',
        'mime_type',
        'file_size',
        'category',
        'tags',
        'is_public',
        'downloads',
    ];

    public $translatable = [
        'title',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'is_public' => 'boolean',
        ];
    }

    public function incrementDownloads()
    {
        $this->increment('downloads');
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'filename' => $this->filename,
            'category' => $this->category,
            'tags' => $this->tags,
        ];
    }
}
