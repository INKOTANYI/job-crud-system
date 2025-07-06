<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewRegistration extends Model
{
    protected $table = 'newregistration';
    protected $fillable = [
        'names', 'phone', 'email', 'id_number', 'department_id',
        'cv', 'degree', 'id_doc', 'province_id', 'district_id', 'sector_id'
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