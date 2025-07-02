<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Company;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::first(); // Get the first company

        if ($company) {
            Job::create([
                'job_title' => 'Software Engineer',
                'job_description' => 'Develop and maintain web applications.',
                'job_qualification' => 'Degree in Masters and 10 years experience',
                'company_id' => $company->id,
                'job_deadline' => '2025-06-30',
                'province' => 'Kigali',
                'district' => 'Gasabo',
                'sector' => 'Kacyiru',
            ]);

            Job::create([
                'job_title' => 'Data Analyst',
                'job_description' => 'Analyze data and generate reports.',
                'job_qualification' => 'Degree in Statistics and 5 years experience',
                'company_id' => $company->id,
                'job_deadline' => '2025-07-15',
                'province' => 'Kigali',
                'district' => 'Nyarugenge',
                'sector' => 'Nyamirambo',
            ]);
        } else {
            throw new \Exception('No companies found. Please seed the companies table first.');
        }
    }
}
