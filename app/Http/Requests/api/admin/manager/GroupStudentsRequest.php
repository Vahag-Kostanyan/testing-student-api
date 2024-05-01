<?php

namespace App\Http\Requests\api\admin\manager;

use App\Http\Requests\api\BaseApiRequestTrait;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class GroupStudentsRequest extends FormRequest
{
    use BaseApiRequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_ids.*' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    /**
     * @param int $id
     */
    public function after_validation(int $id)
    {
        $studentRoleId = Role::where('name', 'student')->first()->id;

        if(!Group::find($id)){
            validationException(['Invalid group id']);
        }

        foreach($this->input('user_ids') as $key => $user_id){
            if(!User::where('role_id', $studentRoleId)->find($user_id)){
                validationException(["The selected user_ids.$key is invalid."]);
            }
        }
    }
}
