<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionModel;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(["name"=> "superAdmin"]);
    
        // $permission = Permission::create([
        //     "title"=> "superAdmin",
        //     "page"=> "all",
        //     'type' => 'all',
        //     "method"=> "all",
        //     "group_id" => '65f5dd6e67d74',
        //     "parent_group_id" => null
        // ]);

        // RolePermission::create([
        //     "role_id"=> $role->id,
        //     "permission_id"=> $permission->id,
        // ]);
    }
}
