<?php

namespace App\Transformers;

use App\Models\Payroll;
use League\Fractal\TransformerAbstract;

class PayrollTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Payroll $payroll)
    {
        return [
            'id' => $payroll->id,
            'employee_name' => $payroll->employee->full_name,
            'incentive' => \App\Helpers\PriceHelper::format($payroll->incentive),
            'salary' => \App\Helpers\PriceHelper::format($payroll->salary),
            'total' => \App\Helpers\PriceHelper::format($payroll->total),
            'status' => $payroll->getStatusHtml(),
            'created_at' => $payroll->created_at->format('d M Y (H:i)'),
            'updated_at' => $payroll->updated_at->format('d M Y (H:i)'),
            'actions' => view('partials.payroll.table-action', compact('payroll'))->render(),
        ];
    }
}
