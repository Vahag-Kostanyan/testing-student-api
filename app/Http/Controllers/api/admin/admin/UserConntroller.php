<?php

namespace App\Http\Controllers\api\admin\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrait\admin\admin\UserValidationTrait;
use App\Models\User;
use App\Repositories\api\admin\admin\user\UserRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;

class UserConntroller extends ApiCrudController implements ApiCrudInterface
{
    use UserValidationTrait;
    protected $modelClass = User::class;
    protected $searchField = ['id', 'username', 'email', 'created_at', 'updated_at'];
    protected $allowedIncludes = ['role', 'role.rolePermissions', 'role.rolePermissions.permission', 'userProfile', 'teacherSubjects'];

    /**
     * @param UserRepositoryInterface $userRepository
     * @param ApiCrudRepositoryInterface $apiCrudRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, ApiCrudRepositoryInterface $apiCrudRepository){
        parent::__construct($apiCrudRepository);
        $this->storeRepository = $userRepository;
        $this->updateRepository = $userRepository;
    }
}