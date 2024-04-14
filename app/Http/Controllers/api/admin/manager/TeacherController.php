<?php

namespace App\Http\Controllers\api\admin\manager;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrate\admin\manager\TeachersValidationTrate;
use App\Models\User;
use App\Repositories\api\admin\admin\user\UserRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;

class TeacherController extends ApiCrudController implements ApiCrudInterface
{
    use TeachersValidationTrate;
    protected $modelClass = User::class;
    protected $searchFaild = ['id', 'username', 'email'];
    protected $role_id = 4;
    
    /**
     * @param UserRepositoryInterface $userRepository
     * @param ApiCrudRepositoryInterface $apiCrudRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, ApiCrudRepositoryInterface $apiCrudRepository)
    {
        parent::__construct($apiCrudRepository);
        $this->storeRepository = $userRepository;
        $this->updateRepository = $userRepository;
    }
}