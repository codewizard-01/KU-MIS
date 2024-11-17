<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = ['Engineering', 'Medicine', 'Business', 'Arts'];

        foreach ($faculties as $faculty) {
            Faculty::create(['name' => $faculty]);
        }
    }
}