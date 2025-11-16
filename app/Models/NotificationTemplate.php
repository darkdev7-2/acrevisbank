<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'subject',
        'body',
        'placeholders',
        'is_active',
        'is_system',
        'category',
    ];

    protected function casts(): array
    {
        return [
            'placeholders' => 'array',
            'is_active' => 'boolean',
            'is_system' => 'boolean',
        ];
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByCode($query, string $code)
    {
        return $query->where('code', $code);
    }

    // Helper methods
    public function render(array $data = []): string
    {
        $body = $this->body;

        foreach ($data as $key => $value) {
            $placeholder = '{{' . $key . '}}';
            $body = str_replace($placeholder, $value, $body);
        }

        return $body;
    }

    public function renderSubject(array $data = []): ?string
    {
        if (!$this->subject) {
            return null;
        }

        $subject = $this->subject;

        foreach ($data as $key => $value) {
            $placeholder = '{{' . $key . '}}';
            $subject = str_replace($placeholder, $value, $subject);
        }

        return $subject;
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'email' => 'Email',
            'sms' => 'SMS',
            'push' => 'Push',
            'message' => 'Message interne',
            default => ucfirst($this->type),
        };
    }

    /**
     * Get template by code
     */
    public static function getByCode(string $code): ?self
    {
        return self::active()->where('code', $code)->first();
    }
}
