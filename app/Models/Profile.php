<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $guarded = [];

    public function getLogoPath()
    {
        return 'images/company/';
    }

    public function getLogoUrlAttribute()
    {
        $logo = asset('assets/img/company/logo-placeholder.jpg');

        if ($this->logo && Storage::disk('public')->exists($this->getLogoPath() . $this->logo)) {
            $logo = Storage::disk('public')->url($this->getLogoPath() . $this->logo);
        }

        return $logo;
    }
}
