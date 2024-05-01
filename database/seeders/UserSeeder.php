<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(40)->create();

        foreach($users as $user){
            UserProfile::create([
                'user_id' => $user->id
            ]);
        }
    }
}
