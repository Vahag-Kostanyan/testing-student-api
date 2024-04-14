<?php

namespace App\Http\Controllers\api\admin\manager;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrate\admin\manager\GroupValidationTrate;
use App\Models\Group;
use App\Repositories\api\admin\manager\group\GroupRepositoryInterface;
use App\Repositories\core\ApiCrudRepositoryInterface;

class GroupController extends ApiCrudController implements ApiCrudInterface
{
    use GroupValidationTrate;
    protected $modelClass = Group::class;

    /**
     * @param GroupRepositoryInterface $groupRepository
     * @param ApiCrudRepositoryInterface $apiCrudRepository
     */
    public function __construct(ApiCrudRepositoryInterface $apiCrudRepository, GroupRepositoryInterface $groupRepository)
    {
        parent::__construct($apiCrudRepository);
        $this->storeRepository = $groupRepository;
        $this->updateRepository = $groupRepository;
        $this->destroyRepository = $groupRepository; 
    }
}