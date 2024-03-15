<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\SubPermission;
use Illuminate\Database\Seeder;

class SubPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::all();


        foreach($permissions  as $permission)
        {   
            if($permission->page == '/admin/role' && $permission->method == 'read')
            {
                SubPermission::create([
                    'permission_id' => $permission->id,
                    'page' => '/admin/permission',
                    'method' => 'read',
                ]);
            }
            SubPermission::create([
                'permission_id' => $permission->id,
                'page' => $permission->page,
                'method' => $permission->method,
            ]);
        }
    }
}
