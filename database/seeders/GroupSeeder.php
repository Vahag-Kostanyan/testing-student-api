<?php

namespace Database\Seeders;

use App\Models\GroupType;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupTypes = ['Course', 'Group', 'Sub Group'];
        
        foreach($groupTypes as $groupType){
            GroupType::create([
                'name' => $groupType,
                'description' => 'somethhing'
            ]);
        }
    }
}
