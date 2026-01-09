<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Policies\CategoryPolicy;

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
  
    // Admin can do everything
    Gate::before(function ($user, $ability) {
        if ($user->hasRole('admin')) {
            return true;
        }
        return null; // continue checking other gates
    });

    // Define specific gates
    Gate::define('users.manage', function ($user) {
        return $user->hasPermission('users.manage');
    });

    Gate::define('products.create', function ($user) {
        return $user->hasPermission('products.create');
    });

    Gate::define('products.update', function ($user) {
        return $user->hasPermission('products.update');
    });

    Gate::define('products.delete', function ($user) {
        return $user->hasPermission('products.delete');
    });

    Gate::define('categories.create', function ($user) {
        return $user->hasPermission('categories.create');
    });

    Gate::define('categories.update', function ($user) {
        return $user->hasPermission('categories.update');
    });

    Gate::define('categories.delete', function ($user) {
        return $user->hasPermission('categories.delete');
    });
    // Register Policies (Part 4 addition)
        Gate::policy(Category::class, CategoryPolicy::class);
}
}
