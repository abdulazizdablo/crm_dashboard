<?php

namespace App\Providers;

 use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
 use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('delete-project', [UserPolicy::class, 'delete']);
        Gate::define('delete-task', function () {
            return  auth()->user()->hasRole('admin');
        });

    }
}
