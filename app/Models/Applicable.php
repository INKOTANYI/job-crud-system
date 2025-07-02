<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicable extends Model
{
    protected $fillable = [
        'names', 'phone', 'email', 'id_number', 'department_id', 'province_id',
        'district_id', 'sector_id', 'job_id', 'cv', 'degree', 'id_doc'
    ];

    protected $table = 'applicables'; // Changed from 'applications'

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }
}