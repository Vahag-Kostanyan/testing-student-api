<?php

namespace App\Http\Controllers\api\admin\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrate\admin\admin\UserValidationTrate;
use App\Models\User;
use App\Repositories\api\admin\admin\user\UserRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;

class UserConntroller extends ApiCrudController implements ApiCrudInterface
{
    use UserValidationTrate;
    protected $modelClass = User::class;
    protected $searchFaild = ['id', 'username', 'email'];

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, ApiCrudRepositoryInterface $apiCrudRepository){
        parent::__construct($apiCrudRepository);
        $this->storeRepository = $userRepository;
        $this->updateRepository = $userRepository;
    }
}