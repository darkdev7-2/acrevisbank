<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Transaction;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    // Filament panel access
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        // Allow access if user has 'access dashboard' permission
        return $this->hasPermissionTo('access dashboard');
    }
}
