<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akazi extends Model
{
    protected $table = 'akazi';
    protected $fillable = [
        'title', 'description', 'qualification', 'company_id', 'department_id',
        'deadline', 'province_id', 'district_id', 'sector_id', 'location'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

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
}