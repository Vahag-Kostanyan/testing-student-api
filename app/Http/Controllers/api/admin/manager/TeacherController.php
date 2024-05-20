<?php

namespace App\Http\Controllers\api\admin\manager;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\admin\manager\TeacherSubjectsRequest;
use App\Http\Requests\api\ValidationTrait\admin\manager\TeachersValidationTrait;
use App\Models\User;
use App\Repositories\api\admin\admin\user\UserRepositoryInterface;
use App\Repositories\api\admin\manager\teacher\TeacherRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;
use Illuminate\Http\JsonResponse;

class TeacherController extends ApiCrudController implements ApiCrudInterface
{
    use TeachersValidationTrait;
    protected $modelClass = User::class;
    protected $searchField = ['id', 'username', 'email', 'created_at', 'updated_at'];
    protected $allowedIncludes = ['userProfile', 'teacherSubjects'];
    protected $role_id = 4;
    
    /**
     * @param TeacherRepositoryInterface $teacherRepository
     * @param UserRepositoryInterface $userRepository
     * @param ApiCrudRepositoryInterface $apiCrudRepository
     */
    public function __construct(
        private TeacherRepositoryInterface $teacherRepository,
        UserRepositoryInterface $userRepository,
        ApiCrudRepositoryInterface $apiCrudRepository
        )
    {
        parent::__construct($apiCrudRepository);
        $this->storeRepository = $userRepository;
        $this->updateRepository = $userRepository;
    }

    /**
     * @param TeacherSubjectsRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateTeacherSubjects(TeacherSubjectsRequest $request, int $id) : JsonResponse
    {
        $request->after_validation($id);
        return response()->json($this->teacherRepository->updateTeacherSubjects($request, $id), 200);
    }
}