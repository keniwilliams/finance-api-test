<?php

namespace App\Providers;

use App\Models\Account;
use App\Policies\AccountPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Account::class => AccountPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // IMPORTANT:
        // No Passport::routes()
        // No Passport::enablePasswordGrant()
        // No Passport::enableRefreshTokens()
        // No Passport::anything()
    }
}
