<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\CreditRequest;
use App\Models\Article;
use App\Models\Service;
use App\Models\Agency;
use App\Models\Page;
use App\Models\MediaFile;
use App\Models\Beneficiary;
use App\Policies\UserPolicy;
use App\Policies\AccountPolicy;
use App\Policies\TransactionPolicy;
use App\Policies\CreditRequestPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\ServicePolicy;
use App\Policies\AgencyPolicy;
use App\Policies\PagePolicy;
use App\Policies\MediaFilePolicy;
use App\Policies\BeneficiaryPolicy;
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
        Article::class => ArticlePolicy::class,
        Service::class => ServicePolicy::class,
        Agency::class => AgencyPolicy::class,
        Page::class => PagePolicy::class,
        MediaFile::class => MediaFilePolicy::class,
        Beneficiary::class => BeneficiaryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
