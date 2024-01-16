<?php

namespace Database\Seeders;

use App\Models\PermissionModel;
use App\Models\RoleModel;
use App\Models\RolePermissionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = RoleModel::create(["name"=> "superAdmin"]);
    
        $permission = PermissionModel::create([
            "name"=> "adminPanel",
            "definer"=> "admin_panel",
            "page"=> "/",
            "permission"=> "1111",
        ]);

        RolePermissionModel::create([
            "role_id"=> $role->id,
            "permission_id"=> $permission->id,
        ]);
    }
}
