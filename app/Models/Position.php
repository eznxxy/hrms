<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $guarded = [];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function structurals()
    {
        return $this->hasMany(Structural::class, 'employee_id', 'id');
    }

    public function salary()
    {
        return $this->hasOne(Salary::class, 'position_id', 'id');
    }
}
