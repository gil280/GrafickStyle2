<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define simple gates for controller abilities used in API controllers
        // TODO: replace with real permission checks (roles/permissions) in production
        Gate::define('ver', fn($user) => (bool) $user);
        Gate::define('crear', fn($user) => (bool) $user);
        Gate::define('Actualizar', fn($user) => (bool) $user);
        Gate::define('Eliminar', fn($user) => (bool) $user);
    }
}
