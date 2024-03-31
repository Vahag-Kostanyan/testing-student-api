<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class SuperAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(["name"=> "superAdmin"]);

        $permissions = Permission::all();

        foreach($permissions as $permission){
            RolePermission::create([
                "role_id"=> $role->id,
                "permission_id"=> $permission->id,
            ]);
        }

    }
}
