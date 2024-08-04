<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Repositories\Users\UsersRepositoryInterface::class, \App\Repositories\Users\UsersRepository::class);
        $this->app->singleton(\App\Repositories\Category\CategoryRepositoryInterface::class, \App\Repositories\Category\CategoryRepository::class);
        $this->app->singleton(\App\Repositories\Products\ProductsRepositoryInterface::class, \App\Repositories\Products\ProductsRepository::class);
        $this->app->singleton(\App\Repositories\Attributes\AttributeRepositoryInterface::class, \App\Repositories\Attributes\AttributeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
