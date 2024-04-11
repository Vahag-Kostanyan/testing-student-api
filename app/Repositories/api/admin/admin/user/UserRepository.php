<?php

namespace App\Repositories\api\admin\admin\user;

use App\Http\Requests\api\admin\admin\ChangePasswordRequest;
use App\Models\User;
use App\Models\UserProfile;
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
            $user = User::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'role_id' => $request->input('role_id'),
                'password' => Hash::make($request->input('password')),
            ]);

            if($request->input('user_profile')){
                UserProfile::create([
                    'user_id' => $user->id,
                    'first_name' => $request->input('user_profile.first_name') ?? null,
                    'last_name' => $request->input('user_profile.last_name') ?? null,
                    'middle_name' => $request->input('user_profile.middle_name') ?? null,
                    'age' => $request->input('user_profile.age') ?? null,
                    'courses' => $request->input('user_profile.courses') ?? null,
                ]);
            }

            DB::commit();
        }catch(Exception $error){
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'status' => false,
                'errors' => ['Something went wrong, contact support!'],
            ], 500));
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
            $user = User::find($id);

            if($user) {
                foreach ($request->only(['username', 'email', 'password', 'role_id']) as $key => $value) {
                    if (array_key_exists($key, $user->getAttributes())) {
                        $user->{$key} = $value; // Update the attribute with the new value
                    }
                }            
            }

            $userProfile = $user->load('userProfile')->userProfile;
            
            $userProfileDatas = empty($request->only(['user_profile.first_name', 'user_profile.last_name', 'user_profile.middle_name', 'user_profile.age', 'user_profile.courses']))
            ? []
            : $request->only(['user_profile.first_name', 'user_profile.last_name', 'user_profile.middle_name', 'user_profile.age', 'user_profile.courses'])['user_profile'];

            if($userProfile && $userProfileDatas) {
                foreach ($userProfileDatas as $key => $value) {
                    if (array_key_exists($key, $userProfile->getAttributes())) {
                        $userProfile->{$key} = $value; // Update the attribute with the new value
                    }
            }
            }

            $userProfile->save();
            $user->save();
            DB::commit();
        }catch(Exception $error){
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'status' => false,
                'errors' => ['Something went wrong, contact support!'],
            ], 500));
        }

        return ['message' => 'User updated successfuly', 'data' => $user->load('userProfile')];
    }


    /**
     * @param ChangePasswordRequest $request
     * @return array
     */
    public function changePassword(ChangePasswordRequest $request) : array
    {
        $user = auth()->user();

        if (!Hash::check($request->input('password'), $user->password)) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => ['Wrong password'],
            ], 422));
        }

        $user->password = Hash::make($request->input('newPassword'));
        $user->save();

        return ['message' => 'Password changed successfully'];
    }
}