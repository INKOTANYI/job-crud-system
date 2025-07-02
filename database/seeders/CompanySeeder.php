<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Province;
use App\Models\District;
use App\Models\Sector;
use App\Models\Category;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $provinces = Province::all();
        $districts = District::all();
        $sectors = Sector::all();
        $categories = Category::all();

        // Debug: Log the counts
        \Log::info('Province count: ' . $provinces->count());
        \Log::info('District count: ' . $districts->count());
        \Log::info('Sector count: ' . $sectors->count());
        \Log::info('Category count: ' . $categories->count());

        // Safety checks to ensure we have enough data
        if ($provinces->count() < 5 || $districts->count() < 11 || $sectors->count() < 23 || $categories->count() < 5) {
            throw new \Exception('Not enough provinces, districts, sectors, or categories to seed companies.');
        }

        $companies = [
            [
                'company_name' => 'Rwanda Tech Solutions',
                'logo' => 'logos/tech_solutions.png',
                'description' => 'A leading tech company in Rwanda.',
                'location' => 'Kigali',
                'province_id' => $provinces[0]->id,
                'district_id' => $districts[0]->id,
                'sector_id' => $sectors[0]->id,
                'category_id' => $categories[0]->id,
            ],
            [
                'company_name' => 'Kigali Health Group',
                'logo' => 'logos/health_group.png',
                'description' => 'Healthcare services provider.',
                'location' => 'Kigali',
                'province_id' => $provinces[0]->id,
                'district_id' => $districts[1]->id,
                'sector_id' => $sectors[1]->id,
                'category_id' => $categories[1]->id,
            ],
            [
                'company_name' => 'EduRwanda',
                'logo' => 'logos/edurwanda.png',
                'description' => 'Education consultancy firm.',
                'location' => 'Huye',
                'province_id' => $provinces[1]->id,
                'district_id' => $districts[2]->id,
                'sector_id' => $sectors[2]->id,
                'category_id' => $categories[2]->id,
            ],
            [
                'company_name' => 'FinanceCorp Rwanda',
                'logo' => 'logos/financecorp.png',
                'description' => 'Financial services provider.',
                'location' => 'Musanze',
                'province_id' => $provinces[2]->id,
                'district_id' => $districts[3]->id,
                'sector_id' => $sectors[3]->id,
                'category_id' => $categories[3]->id,
            ],
            [
                'company_name' => 'EngiBuild Rwanda',
                'logo' => 'logos/engibuild.png',
                'description' => 'Engineering and construction firm.',
                'location' => 'Rubavu',
                'province_id' => $provinces[3]->id,
                'district_id' => $districts[4]->id,
                'sector_id' => $sectors[4]->id,
                'category_id' => $categories[4]->id,
            ],
            [
                'company_name' => 'TechTrend Innovations',
                'logo' => 'logos/techtrend.png',
                'description' => 'Innovative tech solutions.',
                'location' => 'Kigali',
                'province_id' => $provinces[0]->id,
                'district_id' => $districts[0]->id,
                'sector_id' => $sectors[0]->id,
                'category_id' => $categories[0]->id,
            ],
            [
                'company_name' => 'MediCare Rwanda',
                'logo' => 'logos/medicare.png',
                'description' => 'Medical care services.',
                'location' => 'Huye',
                'province_id' => $provinces[1]->id,
                'district_id' => $districts[2]->id,
                'sector_id' => $sectors[2]->id,
                'category_id' => $categories[1]->id,
            ],
            [
                'company_name' => 'LearnEasy Academy',
                'logo' => 'logos/learneasy.png',
                'description' => 'Educational services.',
                'location' => 'Musanze',
                'province_id' => $provinces[2]->id,
                'district_id' => $districts[3]->id,
                'sector_id' => $sectors[3]->id,
                'category_id' => $categories[2]->id,
            ],
            [
                'company_name' => 'BankPro Rwanda',
                'logo' => 'logos/bankpro.png',
                'description' => 'Banking services.',
                'location' => 'Rubavu',
                'province_id' => $provinces[3]->id,
                'district_id' => $districts[4]->id,
                'sector_id' => $sectors[4]->id,
                'category_id' => $categories[3]->id,
            ],
            [
                'company_name' => 'ConstructElite',
                'logo' => 'logos/constructelite.png',
                'description' => 'Construction services.',
                'location' => 'Kigali',
                'province_id' => $provinces[0]->id,
                'district_id' => $districts[0]->id,
                'sector_id' => $sectors[0]->id,
                'category_id' => $categories[4]->id,
            ],
            [
                'company_name' => 'SoftDev Rwanda',
                'logo' => 'logos/softdev.png',
                'description' => 'Software development firm.',
                'location' => 'Huye',
                'province_id' => $provinces[1]->id,
                'district_id' => $districts[2]->id,
                'sector_id' => $sectors[2]->id,
                'category_id' => $categories[0]->id,
            ],
            [
                'company_name' => 'HealthPlus Clinic',
                'logo' => 'logos/healthplus.png',
                'description' => 'Health clinic.',
                'location' => 'Musanze',
                'province_id' => $provinces[2]->id,
                'district_id' => $districts[3]->id,
                'sector_id' => $sectors[3]->id,
                'category_id' => $categories[1]->id,
            ],
            [
                'company_name' => 'EduFuture Rwanda',
                'logo' => 'logos/edufuture.png',
                'description' => 'Future education solutions.',
                'location' => 'Rubavu',
                'province_id' => $provinces[3]->id,
                'district_id' => $districts[4]->id,
                'sector_id' => $sectors[4]->id,
                'category_id' => $categories[2]->id,
            ],
            [
                'company_name' => 'MoneyWise Bank',
                'logo' => 'logos/moneywise.png',
                'description' => 'Banking and finance.',
                'location' => 'Kigali',
                'province_id' => $provinces[0]->id,
                'district_id' => $districts[0]->id,
                'sector_id' => $sectors[0]->id,
                'category_id' => $categories[3]->id,
            ],
            [
                'company_name' => 'BuildTech Rwanda',
                'logo' => 'logos/buildtech.png',
                'description' => 'Tech-driven construction.',
                'location' => 'Huye',
                'province_id' => $provinces[1]->id,
                'district_id' => $districts[2]->id,
                'sector_id' => $sectors[2]->id,
                'category_id' => $categories[4]->id,
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
