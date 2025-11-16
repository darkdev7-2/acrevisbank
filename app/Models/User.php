<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Transaction;
use App\Traits\HasEncryptedAttributes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasEncryptedAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'whatsapp',
        'country',
        'city',
        'address',
        'postal_code',
        'street',
        'preferred_language',
        'account_type',
        'customer_segment',
        'birth_date',
        'birth_place',
        'nationality',
        'profession',
        'employer',
        'annual_income',
        'funds_source',
        'id_document_type',
        'id_document_number',
        'id_document_path',
        'id_document_expiry',
        'validation_status',
        'validated_at',
        'validated_by',
        'rejection_reason',
        'politically_exposed',
        'tax_residence_country',
        'tax_identification_number',
        'terms_accepted',
        'terms_accepted_at',
        'marketing_consent',
        'marketing_consent_at',
        'is_active',
        'last_login_at',
        'two_factor_enabled',
        'two_factor_email_code',
        'two_factor_email_code_expires_at',
        'two_factor_verified_at',
        'failed_two_factor_attempts',
        'two_factor_locked_until',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_email_code',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
            'id_document_expiry' => 'date',
            'last_login_at' => 'datetime',
            'validated_at' => 'datetime',
            'terms_accepted_at' => 'datetime',
            'marketing_consent_at' => 'datetime',
            'is_active' => 'boolean',
            'terms_accepted' => 'boolean',
            'marketing_consent' => 'boolean',
            'politically_exposed' => 'boolean',
            'annual_income' => 'decimal:2',
            'two_factor_enabled' => 'boolean',
            'two_factor_email_code_expires_at' => 'datetime',
            'two_factor_verified_at' => 'datetime',
            'two_factor_locked_until' => 'datetime',
        ];
    }

    /**
     * Boot method to automatically sync name with first_name and last_name
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            // Auto-generate 'name' from first_name and last_name if they exist
            if (empty($user->name) && ($user->first_name || $user->last_name)) {
                $user->name = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
            }
        });
    }

    // Relations
    public function creditRequests()
    {
        return $this->hasMany(CreditRequest::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Account::class);
    }

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function notificationPreference()
    {
        return $this->hasOne(NotificationPreference::class);
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? '')) ?: $this->name;
    }

    // Filament panel access
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        // Allow access if user has 'Admin' role
        return $this->hasRole('Admin');
    }

    /**
     * Get the attributes that should be encrypted at-rest
     *
     * @return array
     */
    protected function encryptedAttributes(): array
    {
        return [
            'tax_identification_number',
            'id_document_number',
            'phone',
            'whatsapp',
            'address',
            'street',
            'postal_code',
            'birth_place',
            'employer',
        ];
    }
}
