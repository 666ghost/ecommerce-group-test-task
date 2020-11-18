<?php

namespace App\Providers;

use App\Models\Route;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        //$this->registerPolicies();

        Gate::define('view-route', function (?User $user, Route $route) {
            return (new RoleService())->canViewRoute($route);
        });

        Gate::define('view-route-in-tree', function (?User $user, Route $route) {
            return (new RoleService())->canViewRouteInTree($route);
        });
    }
}
