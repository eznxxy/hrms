<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Reimbursement extends Model
{
    protected $guarded = [];

    public function getImagePath()
    {
        return 'images/reimbursements/';
    }

    public function hasImage()
    {
        return $this->document && Storage::disk('public')->exists($this->getImagePath() . $this->image);
    }

    public function deleteImage()
    {
        if (!$this->hasImage()) {
            return false;
        }

        return Storage::disk('public')->delete($this->getImagePath() . $this->image);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::disk('public')->exists($this->getImagePath() . $this->image)) {
            $image = Storage::disk('public')->url($this->getImagePath() . $this->image);
        }

        return $image;
    }

    public function getStatusHtml()
    {
        $statusMap = [
            'pending' => 'badge badge-warning',
            'paid' => 'badge badge-success',
            'declined' => 'badge badge-danger'
        ];
        $class = $statusMap[$this->status] ?? 'badge badge-primary';

        $html = "<span class='{$class}'>{$this->status}</span>";

        return $html;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
