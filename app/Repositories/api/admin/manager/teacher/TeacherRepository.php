<?php

namespace App\Repositories\api\admin\manager\teacher;

use App\Http\Requests\api\admin\manager\TeacherSubjectsRequest;
use App\Models\TeacherSubject;
use App\Models\User;
use Exception;


class TeacherRepository implements TeacherRepositoryInterface
{
    /**
     * @param TeacherSubjectsRequest $request
     * @param string|int $id
     * @return array
     */
    public function updateTeacherSubjects(TeacherSubjectsRequest $request, string|int $id): array
    {

        try {
            $user = User::find($id);

            $teacherSubjects = $user->load('teacherSubjects')->teacherSubjects;

            $subjectIds = $request->input('subject_ids');

            foreach ($teacherSubjects as $teacherSubject) {
                if (!in_array($teacherSubject->subject_id, $subjectIds)) {
                    $teacherSubject->delete();
                } else {
                    $index = array_search($teacherSubject->subject_id, $subjectIds);
                    unset($subjectIds[$index]);
                }
            }

            $newTeacherSubjects = [];
            foreach ($subjectIds as $subjectId) {
                $newTeacherSubjects[] = ['user_id' => $user->id, 'subject_id' => $subjectId, 'created_at' => now(), 'updated_at' => now()];
            }
            TeacherSubject::insert($newTeacherSubjects);

        } catch (Exception $error) {
            serverException();
        }

        return ['message' => 'User updated successfuly', 'data' => $user->load(['userProfile', 'teacherSubjects'])];
    }
}