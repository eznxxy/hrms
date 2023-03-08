<?php

namespace App\Transformers;

use App\Models\Reimbursement;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class ReimbursementTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Reimbursement $reimbursement)
    {
        return [
            'id' => $reimbursement->id,
            'employee_name' => $reimbursement->employee->full_name,
            'name' => $reimbursement->name,
            'nominal' => \App\Helpers\PriceHelper::format($reimbursement->nominal),
            'status' => $reimbursement->getStatusHtml(),
            'created_at' => $reimbursement->created_at->format('d M Y (H:i)'),
            'updated_at' => $reimbursement->updated_at->format('d M Y (H:i)'),
            'actions' => view('partials.reimbursement.table-action', compact('reimbursement'))->render(),
        ];
    }
}
