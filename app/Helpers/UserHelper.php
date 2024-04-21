<?php
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;

/**
 * @param array $data
 * @return User
 */
function CreateUserWithProfile(array $data): User
{
    $user = User::create([
        'username' => $data['username'] ?? null,
        'email' => $data['email'] ?? null,
        'role_id' => $data['role_id'] ?? null,
        'password' => Hash::make($data['password']) ?? null,
    ]);

    UserProfile::create([
        'user_id' => $user->id,
        'first_name' => $data['user_profile']['first_name'] ?? null,
        'last_name' => $data['user_profile']['last_name'] ?? null,
        'middle_name' => $data['user_profile']['middle_name'] ?? null,
        'age' => $data['user_profile']['age'] ?? null,
        'courses' => $data['user_profile']['courses'] ?? null,
    ]);

    return $user;
}

/**
 * @param array $data
 * @param int $id
 * @return User
 */
function UpdateUserWithProfile(array $data, int $id): User
{
    $user = User::find($id);

    if ($user) {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $user->getAttributes())) {
                $user->{$key} = $value; // Update the attribute with the new value
            }
        }
    }

    $userProfile = $user->load('userProfile')->userProfile;

    if ($userProfile && !empty($data['user_profile'])) {
        foreach ($data['user_profile'] as $key => $value) {
            if (array_key_exists($key, $userProfile->getAttributes())) {
                $userProfile->{$key} = $value; // Update the attribute with the new value
            }
        }
    }

    $userProfile->save();
    $user->save();

    return $user;
}