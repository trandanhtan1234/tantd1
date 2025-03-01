<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

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
        $this->app->singleton(\App\Repositories\Order\OrderRepositoryInterface::class, \App\Repositories\Order\OrderRepository::class);
        $this->app->singleton(\App\Repositories\Index\IndexRepositoryInterface::class, \App\Repositories\Index\IndexRepository::class);
        $this->app->singleton(\App\Repositories\Cart\CartRepositoryInterface::class, \App\Repositories\Cart\CartRepository::class);
        $this->app->singleton(\App\Repositories\Customer\CustomerRepositoryInterface::class, \App\Repositories\Customer\CustomerRepository::class);

        // api
        $this->app->singleton(\App\Repositories\Api\Users\UserRepoInterface::class, \App\Repositories\Api\Users\UserRepo::class);
        $this->app->singleton(\App\Repositories\Api\Category\CateRepoInterface::class, \App\Repositories\Api\Category\CateRepo::class);
        $this->app->singleton(\App\Repositories\Api\Products\ProductRepoInterface::class, \App\Repositories\Api\Products\ProductRepo::class);
        $this->app->singleton(\App\Repositories\Api\Order\OrderRepoInterface::class, \App\Repositories\Api\Order\OrderRepo::class);
        $this->app->singleton(\App\Repositories\Api\Customer\CustomerRepoInterface::class, \App\Repositories\Api\Customer\CustomerRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        if (app()->environment('local')) {
            URL::forceRootUrl(request()->root());
            URL::forceScheme('https');
        }
    }
}
