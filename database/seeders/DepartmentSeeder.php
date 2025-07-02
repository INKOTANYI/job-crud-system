<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['name' => 'Engineering'],
            ['name' => 'Healthcare'],
            ['name' => 'Education'],
            ['name' => 'Finance'],
            ['name' => 'Agriculture'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}
