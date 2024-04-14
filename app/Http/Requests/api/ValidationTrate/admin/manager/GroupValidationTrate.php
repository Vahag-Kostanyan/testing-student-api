<?php

namespace App\Http\Requests\api\ValidationTrate\admin\manager;

use App\Models\Role;
use App\Models\User;
use \Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

trait GroupValidationTrate
{
    /**
     * @return array
     * @inheritDoc
     */
    protected function store_validation_rules(): array
    {
        return [
            'parent_id' => ['sometimes', 'exists:group'],
            'user_id' => ['required', 'exists:users,id'],
            'group_type_id' => ['required', 'exists:group_type,id'],
            'subject_ids.*' => ['sometimes', 'exists:subject,id'],
            'name' => ['required', 'string', 'unique:group'],
            'description' => ['sometimes', 'string'],
        ];
    }

    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function store_after_validation(Request $request): void
    {
        $this->after_validate($request);
    }


    /**
     * @return array
     * @inheritDoc
     */
    protected function update_validation_rules(): array
    {
        return [
            'parent_id' => ['sometimes', 'exists:group'],
            'user_id' => ['sometimes', 'exists:users,id'],
            'group_type_id' => ['sometimes', 'exists:group_type,id'],
            'subject_ids.*' => ['sometimes', 'exists:subject,id'],
            'name' => ['sometimes', 'string', 'unique:group'],
            'description' => ['sometimes', 'string'],
        ];
    }

    /**
     * @param Request $request
     * @param int|null $id
     * @return void
     * @throws HttpResponseException
     */
    protected function update_after_validation(Request $request, int|null $id): void
    {
        $this->after_validate($request);
        if ($id == $request->input('parent_id')) 
        {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => ['Invalid parent_id'],
            ], 422));
        }
    }


    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    private function after_validate(Request $request): void
    {
        $teacherRoleId = Role::where('name', 'teacher')->first()->id;

        if (!User::where('id', $request->input('user_id'))->where('role_id', $teacherRoleId)->first()) 
        {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => ['Invalid teacher id'],
            ], 422));
        }
    }
}
