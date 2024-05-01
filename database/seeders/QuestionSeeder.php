<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionTypes = ['question', 'optional_question', 'written_question'];

        $questionTypesSeed = [];
        foreach($questionTypes as $questionType){
            $questionTypesSeed[] = ['name' => $questionType, 'created_at' => now(), 'updated_at' => now()];
        }
        QuestionType::insert($questionTypesSeed);
    
    }
}
