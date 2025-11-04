<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $table = 'newsletter_subscriptions';

    protected $fillable = [
        'email',
        'is_active',
        'subscribed_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'subscribed_at' => 'datetime',
        ];
    }
}
