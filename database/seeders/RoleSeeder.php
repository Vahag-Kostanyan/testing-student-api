<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // superAdmin seed
        $superAdminRole = Role::create(["name"=> "superAdmin"]);
        $superAdminPermissions = Permission::all();

        foreach($superAdminPermissions as $superAdminPermission){
            RolePermission::create([
                "role_id"=> $superAdminRole->id,
                "permission_id"=> $superAdminPermission->id,
            ]);
        }

        // admin seed
        $adminRole = Role::create(["name"=> "admin"]);
        $adminPermissions = Permission::orWhere('page', '/')->orWhere('page', '/profile')->orWhere('page', 'like', '/admin%')->get();

        foreach($adminPermissions as $adminPermission){
            RolePermission::create([
                "role_id"=> $adminRole->id,
                "permission_id"=> $adminPermission->id,
            ]);
        }

        // manager seed
        $managerRole = Role::create(["name"=> "manager"]);
        $managerPermissions = Permission::orWhere('page', '/')->orWhere('page', '/profile')->orWhere('page', 'like', '/manager%')->get();

        foreach($managerPermissions as $managerPermission){
            RolePermission::create([
                "role_id"=> $managerRole->id,
                "permission_id"=> $managerPermission->id,
            ]);
        }

        // teacher seed
        $teacherRole = Role::create(["name"=> "teacher"]);
        $teacherPermissions = Permission::orWhere('page', '/')->orWhere('page', '/profile')->orWhere('page', 'like', '/teacher%')->get();

        foreach($teacherPermissions as $teacherPermission){
            RolePermission::create([
                "role_id"=> $teacherRole->id,
                "permission_id"=> $teacherPermission->id,
            ]);
        }

        // student seed
        $teacherRole = Role::create(["name"=> "student"]);
    }
}
