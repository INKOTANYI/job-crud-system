<?php

namespace App\Registration;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Province;
use App\Models\District;
use App\Models\Sector;

class Registration extends Model
{
    protected $fillable = [
        'names', 'phone', 'email', 'id_number', 'department_id', 'cv', 'degree', 'id_doc',
        'province_id', 'district_id', 'sector_id',
    ];

    protected $casts = [
        'cv' => 'string',
        'degree' => 'string',
        'id_doc' => 'string',
    ];

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
