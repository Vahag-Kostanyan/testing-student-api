<?php

namespace App\Http\Controllers\api\admin\manager;
use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Http\Requests\api\ValidationTrait\admin\manager\SubjectsValidationTrait;
use App\Models\Subject;

class SubjectController extends ApiCrudController implements ApiCrudInterface
{
    use SubjectsValidationTrait;
    protected $modelClass = Subject::class;
    protected $searchField = ['id', 'name', 'created_at', 'updated_at'];
}