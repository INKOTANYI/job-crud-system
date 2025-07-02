<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];

    public function districts()
    {
        return $this->hasMany(District::class, 'province_id'); // Matches the foreign key in districts table
    }
}