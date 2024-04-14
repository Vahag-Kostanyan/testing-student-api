<?php

namespace App\Http\Controllers\api\admin\manager;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\admin\admin\ChangePasswordRequest;
use App\Http\Requests\api\ValidationTrate\admin\manager\StudentsValidationTrate;
use App\Models\User;
use App\Repositories\api\admin\admin\user\UserRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;
use Illuminate\Http\JsonResponse;

class StudentController extends ApiCrudController implements ApiCrudInterface
{
    use StudentsValidationTrate;
    protected $modelClass = User::class;
    protected $searchFaild = ['id', 'username', 'email'];
    protected $role_id = 5;
    
    /**
     * @param UserRepositoryInterface $userRepository
     * @param ApiCrudRepositoryInterface $apiCrudRepository
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        ApiCrudRepositoryInterface $apiCrudRepository
    )
    {
        parent::__construct($apiCrudRepository);
        $this->storeRepository = $this->userRepository;
        $this->updateRepository = $this->userRepository;
    }

    /**
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request) : JsonResponse
    {
        return response()->json($this->userRepository->changePassword($request), 200);
    }
}