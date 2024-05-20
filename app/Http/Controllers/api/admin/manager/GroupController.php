<?php

namespace App\Http\Controllers\api\admin\manager;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\admin\manager\GroupStudentsRequest;
use App\Http\Requests\api\admin\manager\GroupTeacherAndSubjectsRequest;
use App\Http\Requests\api\ValidationTrate\admin\manager\GroupValidationTrate;
use App\Models\Group;
use App\Repositories\api\admin\manager\group\GroupRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;
use Illuminate\Http\JsonResponse;

class GroupController extends ApiCrudController implements ApiCrudInterface
{
    use GroupValidationTrate;
    protected $modelClass = Group::class;
    protected $searchField = ['id', 'name', 'description', 'created_at', 'updated_at'];
    protected $allowedIncludes = ['parent', 'teacher', 'groupType', 'groupUsers', 'groupTeacherSubject', 'groupTeacherSubject.teacher', 'groupTeacherSubject.subject'];

    /**
     * @param GroupRepositoryInterface $groupRepository
     * @param ApiCrudRepositoryInterface $apiCrudRepository
     */
    public function __construct(ApiCrudRepositoryInterface $apiCrudRepository, private GroupRepositoryInterface $groupRepository)
    {
        parent::__construct($apiCrudRepository);
        $this->destroyRepository = $this->groupRepository; 
    }

    /**
     * @param GroupStudentsRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateGroupStudents(GroupStudentsRequest $request, int $id) : JsonResponse
    {
        $request->after_validation($id);
        return response()->json($this->groupRepository->updateGroupStudents($request, $id), 200);
    }

    /**
     * @param GroupTeacherAndSubjectsRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateGroupTeacherAndSubjects(GroupTeacherAndSubjectsRequest $request, int $id) : JsonResponse
    {
        $request->after_validation($id);
        return response()->json($this->groupRepository->updateGroupTeacherAndSubjects($request, $id), 200);
    }
}