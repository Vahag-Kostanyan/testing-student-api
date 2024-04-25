<?php

namespace App\Repositories\api\admin\admin\user;

use App\Http\Requests\api\admin\admin\ChangePasswordRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserRepository implements UserRepositoryInterface
{

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        DB::beginTransaction();

        try{
            $data = $request->only(['username', 'email', 'role_id', 'password', 'user_profile.first_name', 'user_profile.last_name', 'user_profile.middle_name', 'user_profile.age', 'user_profile.courses']);

            $user = CreateUserWithProfile($data);

            DB::commit();
        }catch(Exception $error){
            DB::rollBack();

            serverException();
        }

        return ['message' => 'User created successfuly', 'data' => $user->load('userProfile')];
    }


    /**
     * @param Request $request
     * @param string|int $id
     * @return array
     */
    public function update(Request $request, int|string $id): array
    {
        DB::beginTransaction();

        try{
            $data = $request->only(['username', 'email', 'role_id', 'password', 'user_profile.first_name', 'user_profile.last_name', 'user_profile.middle_name', 'user_profile.age', 'user_profile.courses']);

            $user = UpdateUserWithProfile($data, $id);

            DB::commit();
        }catch(Exception $error){
            DB::rollBack();

            serverException();
        }

        return ['message' => 'User updated successfuly', 'data' => $user->load('userProfile')];
    }


    /**
     * @param ChangePasswordRequest $request
     * @return array
     */
    public function changePassword(ChangePasswordRequest $request) : array
    {
        try{
            $user = auth()->user();

            if (!Hash::check($request->input('password'), $user->password)) {
                validationException(['Wrong password']);
            }
    
            $user->password = Hash::make($request->input('newPassword'));
            $user->save();
    
        }catch(Exception $error){
            serverException();
        }
        
        return ['message' => 'Password changed successfully'];

    }
}