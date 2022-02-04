<?php

namespace App\Providers;

use App\Models\Hrd;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('senior-hrd');
        });

        Gate::define('view', function (Hrd $hrd) {
            return $hrd->hasPermissionTo('view');
        });

        Gate::define('read', function (Hrd $hrd) {
            return $hrd->hasPermissionTo('read');
        });

        Gate::define('add', function (Hrd $hrd) {
            return $hrd->hasPermissionTo('add');
        });

        Gate::define('update', function (Hrd $hrd) {
            return $hrd->hasPermissionTo('update');
        });

        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
