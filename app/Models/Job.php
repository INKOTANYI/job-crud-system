<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $primaryKey = 'job_id';

    protected $fillable = [
        'job_title',
        'job_description',
        'job_qualification',
        'company_id',
        'province_id',
        'district_id',
        'sector_id',
        'department_id',
        'jobcategory_id',
        'job_deadline',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'jobcategory_id');
    }
}