<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['company_name', 'logo', 'description', 'category_id', 'province_id', 'district_id', 'sector_id', 'location'];

    public function jobCategory() // Updated from category
    {
        return $this->belongsTo(JobCategory::class, 'category_id'); // Explicitly specify the foreign key
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
