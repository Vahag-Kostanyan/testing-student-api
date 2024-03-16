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
        $sub_permissons = getSubPermissions();

        foreach ($sub_permissons as $sub_permisson) {
            SubPermission::create($sub_permisson);
    }
    }
}
