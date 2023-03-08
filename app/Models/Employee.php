<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    protected $guarded = [];

    public function getAvatarPath()
    {
        return 'images/avatar/';
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAvatarUrlAttribute()
    {
        $avatar = asset('assets/img/avatar/avatar-1.png');

        if ($this->avatar && Storage::disk('public')->exists($this->getAvatarPath() . $this->avatar)) {
            $avatar = Storage::disk('public')->url($this->getAvatarPath() . $this->avatar);
        }

        return $avatar;
    }

    public function age()
    {
        return Carbon::parse($this->date_of_birth)->age;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function structurals()
    {
        return $this->hasMany(Structural::class, 'employee_id', 'id');
    }

    public function family()
    {
        return $this->hasOne(Family::class, 'employee_id', 'id');
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class, 'employee_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'employee_id', 'id');
    }
}
