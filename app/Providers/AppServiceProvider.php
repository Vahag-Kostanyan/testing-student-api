<?php

namespace App\Providers;

use App\Repositories\api\admin\admin\rolePermission\RolePermissionRepository;
use App\Repositories\api\admin\admin\rolePermission\RolePermissionRepositoryInterface;
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
        $this->app->bind(RolePermissionRepositoryInterface::class, RolePermissionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
