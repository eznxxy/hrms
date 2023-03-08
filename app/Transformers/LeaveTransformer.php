<?php

namespace App\Transformers;

use App\Models\Leave;
use League\Fractal\TransformerAbstract;

class LeaveTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Leave $leave)
    {
        return [
            'employee_name' => $leave->employee->full_name,
            'category_name' => $leave->leave_category->name,
            'start_at' => $leave->start_at->format('d M Y (H:i)'),
            'end_at' => $leave->end_at->format('d M Y (H:i)'),
            'status' => $leave->getStatusHtml(),
            'actions' => view('partials.leave.table-action', compact('leave'))->render(),
        ];
    }
}
