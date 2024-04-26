<?php

namespace App\Repositories\api\admin\manager\teacher;
use App\Http\Requests\api\admin\manager\TeacherSubjectsRequest;

interface TeacherRepositoryInterface 
{
    /**
     * @param TeacherSubjectsRequest $request
     * @param string|int $id
     * @return array
     */
    public function updateTeacherSubjects(TeacherSubjectsRequest $request, string|int $id) : array;
}