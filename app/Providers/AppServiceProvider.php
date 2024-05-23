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
use App\Repositories\api\admin\teacher\group\TeacherGroupRepository;
use App\Repositories\api\admin\teacher\group\TeacherGroupRepositoryInterface;
use App\Repositories\api\admin\teacher\question\QuestionRepository;
use App\Repositories\api\admin\teacher\question\QuestionRepositoryInterface;
use App\Repositories\api\site\test\TestRepository;
use App\Repositories\api\site\test\TestRepositoryInterface;
use App\Repositories\api\site\testQuestionAnswer\TestQuestionAnswerRepository;
use App\Repositories\api\site\testQuestionAnswer\TestQuestionAnswerRepositoryInterface;
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
        $this->app->bind(TeacherGroupRepositoryInterface::class, TeacherGroupRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(TestRepositoryInterface::class, TestRepository::class);
        $this->app->bind(TestQuestionAnswerRepositoryInterface::class, TestQuestionAnswerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
