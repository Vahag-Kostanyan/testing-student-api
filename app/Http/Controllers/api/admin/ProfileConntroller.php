<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\admin\admin\ChangePasswordRequest;
use App\Http\Requests\api\ValidationTrait\admin\admin\ProfileValidationTrait;
use App\Models\User;
use App\Repositories\api\admin\admin\user\UserRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProfileConntroller extends ApiCrudController implements ApiCrudInterface
{
    use ProfileValidationTrait;
    protected $modelClass = User::class;
    
    /**
     * @param UserRepositoryInterface $userRepository
     * @param ApiCrudRepositoryInterface $apiCrudRepository
     */
    public function __construct(ApiCrudRepositoryInterface $apiCrudRepository, private UserRepositoryInterface $userRepository)
    {
        parent::__construct($apiCrudRepository);
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