<?php

namespace App\Http\Requests\api\admin\manager;

use App\Http\Requests\api\BaseApiRequestTrait;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class TeacherSubjectsRequest extends FormRequest
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
            'subject_ids.*' => ['sometimes', 'required', 'nullable', 'exists:subject,id'],
        ];
    }

    /**
     * @param int $id
     */
    public function after_validation(int $id)
    {
        $teacherRoleId = Role::where('name', 'teacher')->first()->id;

        if(!User::where('role_id', $teacherRoleId)->find($id)){
            validationException(['teacher id is invalide!']);
        }

        if($this->has('subject_ids')){
            $this->merge(['subject_ids' => array_unique($this->input('subject_ids'))]);
        }   
    }
}
