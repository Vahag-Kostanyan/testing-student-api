<?php

namespace App\Repositories\api\admin\manager\group;

use App\Http\Requests\api\admin\manager\GroupStudentsRequest;
use App\Http\Requests\api\admin\manager\GroupTeacherAndSubjectsRequest;
use App\Models\Group;
use App\Models\GroupTeacherSubject;
use App\Models\GroupUser;
use Exception;
use Illuminate\Http\Request;


class GroupRepository implements GroupRepositoryInterface
{

    /**
     * @param Request $request
     * @param int|string $id
     * @return mixed
     */
    public function destroy(Request $request, int|string $id): mixed
    {
        try {
            $group = Group::find($id);

            $groupUsers = $group->load('groupUser')->groupUser;
            foreach($groupUsers as $groupUser){
                $groupUser->delete();
            }

            $groupTeacherSubjects = $group->load('groupTeacherSubject')->groupTeacherSubject;
            foreach($groupTeacherSubjects as $groupTeacherSubject){
                $groupTeacherSubject->delete();
            }

            $group->delete();
        } catch (Exception $error) {
            serverException();
        }


        return ['message' => 'Deleted successfully'];
    }

    /**
     * @param GroupStudentsRequest $request
     * @param int|string $id
     * @return mixed
     */
    public function updateGroupStudents(GroupStudentsRequest $request, int|string $id): array
    {
        try {
            $group = Group::find($id);
            $groupUsers = $group->load('groupUser')->groupUser;

            $userIds = $request->input('user_ids');

            foreach ($groupUsers as $groupUser) {
                if (!in_array($groupUser->user_id, $userIds)) {
                    $groupUser->delete();
                } else {
                    $index = array_search($groupUser->user_id, $userIds);
                    unset($userIds[$index]);
                }
            }
            $newGroupUsers = [];
            foreach ($userIds as $userId) {
                $newGroupUsers[] = ['group_id' => $group->id, 'user_id' => $userId, 'created_at' => now(), 'updated_at' => now()];
            }
            GroupUser::insert($newGroupUsers);
        } catch (Exception $error) {
            serverException();
        }

        return ['message' => 'Updated successfuly', 'data' => $group->load('groupUser')->groupUser];
    }

    /**
     * @param GroupTeacherAndSubjectsRequest $request
     * @param int|string $id
     * @return mixed
     */
    public function updateGroupTeacherAndSubjects(GroupTeacherAndSubjectsRequest $request, int|string $id): array
    {

        try {
            $group = Group::find($id);
            $groupTeacherSubjects = $group->load('groupTeacherSubject')->groupTeacherSubject;

            $teacherAndSubjectIds = $request->input('teacherAndSubject_ids');

            foreach ($groupTeacherSubjects as $groupTeacherSubject) {
                $arrayKey = -1;
                foreach ($teacherAndSubjectIds as $key => $item) {
                    if (
                        $item['user_id'] == $groupTeacherSubject->user_id &&
                        $item['subject_id'] == $groupTeacherSubject->subject_id
                    ) {
                        $arrayKey = $key; break;
                    }
                }
                if($arrayKey !== -1){
                    unset($teacherAndSubjectIds[$arrayKey]);
                }else{
                    $groupTeacherSubject->delete();
                }
            }

            $newTeacherAndSubjects = [];
            foreach ($teacherAndSubjectIds as $item) {
                $newTeacherAndSubjects[] = [
                    'group_id' => $group->id,
                    'subject_id' => $item['subject_id'],
                    'user_id' => $item['user_id'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            GroupTeacherSubject::insert($newTeacherAndSubjects);
        } catch (Exception $error) {
            serverException();
        }

        return ['message' => 'Updated successfuly', 'data' => $group->load('groupTeacherSubject')->groupTeacherSubject];
    }
}