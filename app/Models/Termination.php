<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Termination extends Model
{
    protected $guarded = [];

    protected $casts = [
        'noticed_at' => 'datetime',
        'terminated_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function termination_category()
    {
        return $this->belongsTo(TerminationCategory::class, 'termination_category_id', 'id');
    }
}
