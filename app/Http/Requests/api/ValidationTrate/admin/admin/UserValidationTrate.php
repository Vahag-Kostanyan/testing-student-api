<?php

namespace App\Http\Requests\api\ValidationTrate\admin\admin;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait UserValidationTrate
{
    /**
     * @return array
     * @inheritDoc
     */
    protected function store_validation_rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string'],
            'role_id' => ['required', 'exists:role,id'],
        ];
    }

    /**
     * @param int|string|null $id
     * @param Request $request
     * @return void
     * @inheritDoc
     */
    protected function update_before_validation(Request $request, int|string|null $id) : void
    {
        $user = User::find($id);
        
        if(!$user){
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => ['Invalid user id'],
            ], 422));
        }

        $rules = [];

        if($request->input('username')){
            $rules = [...$rules, 'username' => ['required', 'string']];
        }
        if($request->input('email')){
            $rules = [...$rules, 'email' => ['required', 'string', 'unique:users,email']];
        }
        if($request->input('password')){
            $rules = [...$rules, 'password' => ['required', 'string']];
        }
        if($request->input('role_id')){
            $rules = [...$rules, 'role_id' => ['required', 'exists:role,id']];
        }
        if($request->input('user_profile.first_name')){
            $rules = [...$rules, 'user_profile.first_name' => ['required', 'string']];
        }
        if($request->input('user_profile.last_name')){
            $rules = [...$rules, 'user_profile.last_name' => ['required', 'string']];
        }
        if($request->input('user_profile.middle_name')){
            $rules = [...$rules, 'user_profile.middle_name' => ['required', 'string']];
        }
        if($request->input('user_profile.age')){
            $rules = [...$rules, 'user_profile.age' => ['required', 'integer']];
        }
        if($request->input('user_profile.courses')){
            $rules = [...$rules, 'user_profile.courses' => ['required', 'integer']];
        }

        if(empty($rules)){
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => ['You must provide at least 1 field for update!'],
            ], 422));  
        }

        $validateor = Validator::make($request->all(), $rules);
        if ($validateor->fails()) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => $validateor->errors(),
            ], 422));
        }
    }
}
