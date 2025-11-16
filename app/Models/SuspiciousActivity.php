<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuspiciousActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'severity',
        'ip_address',
        'user_agent',
        'location',
        'details',
        'risk_score',
        'is_resolved',
        'resolved_by',
        'resolved_at',
        'resolution_notes',
        'false_positive',
    ];

    protected $casts = [
        'details' => 'array',
        'risk_score' => 'decimal:2',
        'is_resolved' => 'boolean',
        'false_positive' => 'boolean',
        'resolved_at' => 'datetime',
    ];

    /**
     * Get the user associated with this suspicious activity
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who resolved this activity
     */
    public function resolver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    /**
     * Scope pour filtrer par sévérité
     */
    public function scopeHighRisk($query)
    {
        return $query->whereIn('severity', ['high', 'critical']);
    }

    /**
     * Scope pour les activités non résolues
     */
    public function scopeUnresolved($query)
    {
        return $query->where('is_resolved', false);
    }

    /**
     * Scope pour les activités d'aujourd'hui
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Get formatted severity badge
     */
    public function getSeverityBadgeAttribute(): string
    {
        return match ($this->severity) {
            'low' => '<span class="badge bg-info">Low</span>',
            'medium' => '<span class="badge bg-warning">Medium</span>',
            'high' => '<span class="badge bg-danger">High</span>',
            'critical' => '<span class="badge bg-dark">Critical</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }

    /**
     * Get type description
     */
    public function getTypeDescriptionAttribute(): string
    {
        return match ($this->type) {
            'multiple_login_failures' => 'Tentatives de connexion multiples échouées',
            'ip_change' => 'Changement d\'adresse IP',
            'unusual_time' => 'Connexion à une heure inhabituelle',
            'rapid_transactions' => 'Transactions rapides successives',
            'high_value_transaction' => 'Transaction de valeur élevée',
            'password_change' => 'Changement de mot de passe',
            'location_change' => 'Changement de localisation géographique',
            'session_hijack' => 'Possible détournement de session',
            'brute_force' => 'Tentative de force brute',
            default => $this->type,
        };
    }
}
