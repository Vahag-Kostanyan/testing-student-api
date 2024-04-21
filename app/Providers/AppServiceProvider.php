<?php

namespace App\Providers;

use App\Repositories\api\admin\admin\rolePermission\RolePermissionRepository;
use App\Repositories\api\admin\admin\rolePermission\RolePermissionRepositoryInterface;
use App\Repositories\api\admin\admin\user\UserRepository;
use App\Repositories\api\admin\admin\user\UserRepositoryInterface;
use App\Repositories\api\admin\manager\group\GroupRepository;
use App\Repositories\api\admin\manager\group\GroupRepositoryInterface;
use App\Repositories\api\admin\manager\teacher\TeacherRepository;
use App\Repositories\api\admin\manager\teacher\TeacherRepositoryInterface;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(GroupRepositoryInterface::class, GroupRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
