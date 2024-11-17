<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $departments = [
            'Engineering' => ['Computer Science', 'Civil', 'Electrical'],
            'Medicine' => ['General Medicine', 'Dentistry', 'Pharmacy'],
            'Business' => ['Accounting', 'Marketing', 'Finance'],
            'Arts' => ['Painting', 'Music', 'Drama'],
        ];

        foreach ($departments as $facultyName => $departmentList) {
            $faculty = Faculty::where('name', $facultyName)->first();

            foreach ($departmentList as $departmentName) {
                Department::create([
                    'name' => $departmentName,
                    'faculty_id' => $faculty->id,
                ]);
            }
        }
    }
}