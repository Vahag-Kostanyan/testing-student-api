<?php

namespace App\Repositories\api\admin\teacher\group;

use App\Models\Group;
use App\Models\GroupTeacherSubject;
use Exception;
use Illuminate\Http\Request;


class TeacherGroupRepository implements TeacherGroupRepositoryInterface
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request): mixed
    {
        try {
            $group = Group::query();

            if (!auth()->user()->isSuperAdmin()) {
                $groupTeacherIds = array_column(GroupTeacherSubject::where('user_id', auth()->user()->id)->select('group_id')->get()->toArray(), 'group_id');
                $group->orWhereIn('id', $groupTeacherIds);
                $group->orWhere('id', auth()->user()->id);
            }

            if ($request->has('search')) {
                $group->where(function ($query) use ($request) {
                    $query->where('id', 'like', '%' . $request->input('search') . '%');
                    $query->orWhere('name', 'like', '%' . $request->input('search') . '%');
                    $query->orWhere('description', 'like', '%' . $request->input('search') . '%');
                });
            }

            if ($request->has('sortBy')) {
                $group->orderBy($request->input('sortBy'), $request->input('sortDir') ?? 'asc');
            }

            if ($request->has('limit')) {
                $group->limit($request->input('limit'));
                if ($request->has('page')) {
                    $group->offset($request->input('limit') * ($request->input('page') - 1));
                }
            }

            return [
                'data' => $group->get(),
                'totalData' => $group->count(),
                'limit' => $request->input('limit') ?? null,
                'page' => $request->input('page') ?? null,
            ];
        } catch (Exception $error) {
            serverException();
        }
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return mixed
     */
    public function show(Request $request, int|string $id): mixed
    {
        try {
            return ['data' => Group::with(['groupUsers.user.userProfile'])->find($id)];
        } catch (Exception $error) {
            serverException();
        }
    }
}