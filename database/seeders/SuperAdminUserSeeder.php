<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            "username"=> "superAdmin",
            "email"=> "vahag.kostanyan974@gmail.com",
            'password' => Hash::make("123456789Aa!"),
            'email_verified_at' => time(),
            'email_verified_code' => 123456,
            'role_id' => 1,
        ]);    
    
        UserProfile::create([
            "user_id"=> $superAdmin->id,
        ]);    
    }
}
