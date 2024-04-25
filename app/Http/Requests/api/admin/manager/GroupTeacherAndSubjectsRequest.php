<?php

namespace App\Http\Requests\api\admin\manager;

use App\Http\Requests\api\BaseApiRequestTrait;
use App\Models\Group;
use App\Models\Role;
use App\Models\TeacherSubject;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class GroupTeacherAndSubjectsRequest extends FormRequest
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
            'teacherAndSubject_ids.*.user_id' => ['required', 'integer', 'exists:users,id'],
            'teacherAndSubject_ids.*.subject_id' => ['required', 'integer', 'exists:subject,id'],
        ];
    }

    /**
     * @param int $id
     */
    public function after_validation(int $id)
    {
        if($this->has('teacherAndSubject_ids')){
            $uniqueArray = array_map('json_encode', array_unique(array_map('json_encode', $this->input('teacherAndSubject_ids'))));

            $uniqueArray = array_map('json_decode', $uniqueArray);
      
            $generatedUniqueArray = array_map('json_decode', $uniqueArray, array_fill(0, count($uniqueArray), true));

            $this->merge(['teacherAndSubject_ids' => $generatedUniqueArray]);
        }  

        $studentRoleId = Role::where('name', 'teacher')->first()->id;

        if(!Group::find($id)){
            validationException(['Invalid group id']);
        }

        foreach($this->input('teacherAndSubject_ids') as $key => $item){
            if(!User::where('role_id', $studentRoleId)->find($item['user_id'])){
                validationException(["The selected user_ids.$key is invalid."]);
            }

            if(!TeacherSubject::where('subject_id', $item['subject_id'])->where('user_id', $item['user_id'])->first()){
                validationException(["The selected teacherAndSubject_ids.$key.user_id does not have a subject with this teacherAndSubject_ids.$key.subject_id"]);
            }
        }
    }
}
