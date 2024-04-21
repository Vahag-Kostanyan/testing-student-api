<?php

namespace App\Repositories\api\admin\manager\group;
use App\Http\Requests\api\admin\manager\GroupStudentsRequest;
use App\Http\Requests\api\admin\manager\GroupTeacherAndSubjectsRequest;
use Illuminate\Http\Request;


interface GroupRepositoryInterface 
{
    /**
     * @param Request $request
     * @param int|string $id
     * @return mixed
     */
    public function destroy(Request $request, int|string $id) : mixed;

    /**
     * @param GroupStudentsRequest $request
     * @param int|string $id
     * @return mixed
     */
    public function updateGroupStudents(GroupStudentsRequest $request, int|string $id) : array;

    /**
     * @param GroupTeacherAndSubjectsRequest $request
     * @param int|string $id
     * @return mixed
     */
    public function updateGroupTeacherAndSubjects(GroupTeacherAndSubjectsRequest $request, int|string $id) : array;
}