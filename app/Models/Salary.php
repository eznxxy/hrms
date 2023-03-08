<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $guarded = [];

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}
