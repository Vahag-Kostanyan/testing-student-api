<?php

namespace App\Repositories\api\admin\manager\teacher;

use App\Models\TeacherSubject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TeacherRepository implements TeacherRepositoryInterface
{

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        DB::beginTransaction();

        try {
            $data = $request->only(['username', 'email', 'role_id', 'password', 'user_profile.first_name', 'user_profile.last_name', 'user_profile.middle_name', 'user_profile.age']);

            $user = CreateUserWithProfile($data);

            if ($request->has('subject_ids')) {
                $teacherSubjects = [];
                foreach ($request->input('subject_ids') as $subject_id) {
                    $teacherSubjects[] = ['subject_id' => $subject_id, 'user_id' => $user->id, 'created_at' => now(), 'updated_at' => now()];
                }
                TeacherSubject::insert($teacherSubjects);
            }
            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();

            serverException();
        }

        return ['message' => 'User created successfuly', 'data' => $user->load(['userProfile', 'teacherSubjects'])];
    }


    /**
     * @param Request $request
     * @param string|int $id
     * @return array
     */
    public function update(Request $request, int|string $id): array
    {
        DB::beginTransaction();

        try {
            $data = $request->only(['username', 'email', 'role_id', 'password', 'user_profile.first_name', 'user_profile.last_name', 'user_profile.middle_name', 'user_profile.age']);

            $user = UpdateUserWithProfile($data, $id);

            if ($request->has('subject_ids')) {
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
            }

            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();
            serverException();
        }

        return ['message' => 'User updated successfuly', 'data' => $user->load(['userProfile', 'teacherSubjects'])];
    }
}