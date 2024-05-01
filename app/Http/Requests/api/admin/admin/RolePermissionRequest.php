<?php

namespace App\Http\Requests\api\admin\admin;

use App\Http\Requests\api\BaseApiRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class RolePermissionRequest extends FormRequest
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
            'role_id' => ['required', 'exists:role,id'],
            'permission_ids.*' => ['required', 'exists:permission,id'],
        ];
    }
}
