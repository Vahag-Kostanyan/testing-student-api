<?php

namespace App\Providers;

use App\core\ApiCrudInterface;
use App\Repositories\core\ApiCrudRepository;
use App\Repositories\core\ApiCrudRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiCrudRepositoryInterface::class, ApiCrudRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
