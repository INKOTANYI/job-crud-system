<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobCategory;

class JobCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Full Time',
            'Part Time',
            'Internship',
            'Tender',
            'Scholarship',
        ];

        foreach ($categories as $category) {
            JobCategory::create(['name' => $category]);
        }
    }
}