<?php

namespace App\Http\Controllers\api\admin\teacher;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrate\admin\teacher\GroupValidationTrate;
use App\Models\Group;
use App\Repositories\api\admin\teacher\group\TeacherGroupRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;

class GroupController extends ApiCrudController implements ApiCrudInterface
{
    use GroupValidationTrate;
    protected $modelClass = Group::class;
    protected $searchField = ['id', 'name', 'description', 'created_at', 'updated_at'];
    protected $allowedIncludes = ['parent', 'groupType', 'groupUsers', 'groupUsers.user', 'groupUsers.user.userTests'];

    /**
     * @param TeacherGroupRepositoryInterface $teacherGroupRepository
     * @param ApiCrudRepositoryInterface $apiCrudRepository
     */
    public function __construct(ApiCrudRepositoryInterface $apiCrudRepository, private TeacherGroupRepositoryInterface $teacherGroupRepository)
    {
        parent::__construct($apiCrudRepository);
        $this->indexRepository = $this->teacherGroupRepository; 
        $this->showRepository = $this->teacherGroupRepository; 
    }
}