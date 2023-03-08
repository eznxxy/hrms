<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $guarded = [];

    public function getStatusHtml()
    {
        $statusMap = [
            'pending' => 'badge badge-danger',
            'paid' => 'badge badge-success'
        ];
        $class = $statusMap[$this->status] ?? 'badge badge-primary';

        $html = "<span class='{$class}'>{$this->status}</span>";

        return $html;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function incentive()
    {
        return $this->belongsTo(Incentive::class, 'incentive_id', 'id');
    }
}
