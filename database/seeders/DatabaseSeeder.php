<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            SubPermissionSeeder::class,
            RoleSeeder::class,
            SuperAdminUserSeeder::class,
            UserSeeder::class,
            GroupSeeder::class,
            QuestionSeeder::class,
            TestSeeder::class
        ]);
    }
}
