<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\GroupTeacherSubject;
use App\Models\GroupType;
use App\Models\Role;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\UserProfile;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LoadTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        try{
            $dataFields = ['created_at' => now(), 'updated_at' => now()];

            // Insert subjects test data
            $subjects = [['name' => 'physics', ...$dataFields], ['name' => 'chemistry', ...$dataFields]];
            Subject::insert($subjects);
            
            // Insert students data
            $students = [];
            foreach($this->generateStudents() as $student){
                $students[] = $this->CreateUserWithProfile($student);
            }
            
            // Insert teachers data
            $teachers = [];
            foreach($this->generateTeachers() as $teacher){
                $teachers[] =  $this->CreateUserWithProfile($teacher);
            }

            // Insert teachers subjects data
            $subject_id = Subject::first()->id;
            foreach($teachers as $teacher){
                TeacherSubject::create(['user_id' => $teacher->id, 'subject_id' => $subject_id]);
            }

            // Insert group data
            $group = Group::create($this->generateGroupData($teachers[0]['id']));

            // Insert group teacher subjects data
            $group = GroupTeacherSubject::create(['user_id' => $teachers[0]['id'], 'group_id' =>  $group->id, 'subject_id' => $subject_id]);
        }catch(Exception $error){
            dd($error->getMessage());
        }


    }   

    /**
     * @return array
     */
    private function generateStudents() : array 
    {
        $role_id = Role::where('name','student')->first()->id;

        return [
            [
                'username' => 'ArmenHakobyan',
                'email' => 'armen.hakobyan@gmail.com',
                'password' => Hash::make('123456'),
                'user_profile' => [
                    'first_name' => 'Armen',
                    'last_name' => 'Hakobyan',
                    'middle_name' => 'Hakobi',
                    'age' => 19,
                    'courses' => 4,
                ],
                'role_id' => $role_id,
            ],
            [
                'username' => 'AniManukyan',
                'email' => 'ani.manukyan@gmail.com',
                'password' => Hash::make('123456'),
                'user_profile' => [
                    'first_name' => 'Ani',
                    'last_name' => 'Manukyan',
                    'middle_name' => 'Arseni',
                    'age' => 19,
                    'courses' => 4,
                ],
                'role_id' => $role_id,
            ]
        ];
    }

    /**
     * @return array
     */
    private function generateTeachers() : array 
    {
        $role_id = Role::where('name','teacher')->first()->id;

        return [
            [
                'username' => 'HarutXachatryan',
                'email' => 'harut.xachatryan@gmail.com',
                'password' => Hash::make('123456'),
                'user_profile' => [
                    'first_name' => 'Harut',
                    'last_name' => 'Xachatryan',
                    'middle_name' => 'Sevaki',
                    'age' => 40,
                ],
                'role_id' => $role_id,
            ]
        ];
    }

    /**
     * @param int $subject_id
     * @param int $teacher_id
     * @return array
     */
    private function generateGroupData (int $teacher_id) : array 
    {
        return [
            'name' => '04-1',
            'description' => 'Qolej',
            'group_type_id' => GroupType::first()->id,
            'user_id' => $teacher_id,
        ];
    }

    private function CreateUserWithProfile(array $data){
        $user = User::create([
            'username' => $data['username'] ?? null,
            'email' => $data['email'] ?? null,
            'role_id' => $data['role_id'] ?? null,
            'password' => Hash::make($data['password']) ?? null,
        ]);
    
        UserProfile::create([
            'user_id' => $user->id,
            'first_name' => $data['user_profile']['first_name'] ?? null,
            'last_name' => $data['user_profile']['last_name'] ?? null,
            'middle_name' => $data['user_profile']['middle_name'] ?? null,
            'age' => $data['user_profile']['age'] ?? null,
            'courses' => $data['user_profile']['courses'] ?? null,
        ]);
        
        return $user;
    }
}
