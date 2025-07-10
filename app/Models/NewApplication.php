<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewApplication extends Model
{
    protected $fillable = [
        'full_name', 'phone', 'email', 'id_number', 'department_id',
        'province_id', 'district_id', 'sector_id', 'cv', 'degree', 'id_doc'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
