<?php

namespace App\Providers;

use App\Models\User;
//use App\View\Components\TempleCard;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
//use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void { }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        // Blade::component('temple-card', TempleCard::class);
//        Paginator::useBootstrapFive();

        Gate::define('admin', function (User $user) {
            return $user['is-admin'];
        });
    }
}
