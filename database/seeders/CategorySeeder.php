<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Technology',
            'Healthcare',
            'Education',
            'Finance',
            'Engineering',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
