<?php

namespace App\Repositories\api\admin\manager\group;

use App\Models\Group;
use App\Models\GroupSubject;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GroupRepository implements GroupRepositoryInterface
{

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        DB::beginTransaction();

        try {
            $group = Group::create($request->only(['user_id', 'group_type_id', 'name', 'description', 'parent_id']));

            if ($request->has('subject_ids')) {
                $groupSubjects = [];
                foreach ($request->input('subject_ids') as $subjectId) {
                    $groupSubjects[] = ['group_id' => $group->id, 'subject_id' => $subjectId, 'created_at' => now(), 'updated_at' => now()];
                }
                GroupSubject::insert($groupSubjects);
            }

            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'status' => false,
                'errors' => ['Something went wrong, contact support!'],
            ], 500));
        }

        return ['message' => 'User created successfuly', 'data' => $group->load(['groupSubjects', 'groupType'])];
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

            $group = Group::find($id);

            if ($group) {
                foreach ($request->only(['user_id', 'parent_id', 'group_type_id', 'name', 'description']) as $key => $value) {
                    if (array_key_exists($key, $group->getAttributes())) {
                        $group->{$key} = $value; // Update the attribute with the new value
                    }
                }
            }

            if ($request->has('subject_ids')) {
                $groupSubjects = $group->load('groupSubjects')->groupSubjects;

                $subjectIds = $request->input('subject_ids');

                foreach ($groupSubjects as $groupSubject) {
                    if (!in_array($groupSubject->subject_id, $subjectIds)) {
                        $groupSubject->delete();
                    } else {
                        $index = array_search($groupSubject->subject_id, $subjectIds);
                        unset($subjectIds[$index]);
                    }
                }
                $newGroupSubjects = [];
                foreach ($subjectIds as $subjectId) {
                    $newGroupSubjects[] = ['group_id' => $group->id, 'subject_id' => $subjectId, 'created_at' => now(), 'updated_at' => now()];
                }
                GroupSubject::insert($newGroupSubjects);
            }

            $group->save();
            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'status' => false,
                'errors' => ['Something went wrong, contact support!'],
            ], 500));
        }

        return ['message' => 'User created successfuly', 'data' => $group->load(['groupSubjects', 'groupType'])];
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return mixed
     */
    public function destroy(Request $request, int|string $id): mixed
    {
        try {
            $group = Group::find($id);

            foreach ($group->load('groupSubjects')->groupSubjects as $item) {
                $item->delete();
            }

            $group->delete();
        } catch (Exception $error) {
            throw new HttpResponseException(response()->json([
                'status' => false,
                'errors' => ['Something went wrong, contact support!'],
            ], 500));
        }


        return ['message' => 'Deleted successfully'];
    }
}