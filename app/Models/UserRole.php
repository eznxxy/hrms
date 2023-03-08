<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'role_id', 'id');
    }
}
