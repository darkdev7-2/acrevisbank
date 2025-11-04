<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\CreditRequest;
use App\Policies\UserPolicy;
use App\Policies\AccountPolicy;
use App\Policies\TransactionPolicy;
use App\Policies\CreditRequestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Account::class => AccountPolicy::class,
        Transaction::class => TransactionPolicy::class,
        CreditRequest::class => CreditRequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
