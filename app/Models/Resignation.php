<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resignation extends Model
{
    protected $guarded = [];

    protected $casts = [
        'noticed_at' => 'datetime',
        'resigned_at' => 'datetime',
    ];

    public function getStatusHtml()
    {
        $statusMap = [
            'sent' => 'badge badge-primary',
            'in review' => 'badge badge-info',
            'declined' => 'badge badge-danger',
            'approved' => 'badge badge-success'
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
