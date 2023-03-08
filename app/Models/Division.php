<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $guarded = [];

    public function positions()
    {
        return $this->hasMany(Position::class, 'division_id', 'id');
    }
}
