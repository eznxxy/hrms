<?php

namespace App\Transformers;

use App\Models\Resignation;
use League\Fractal\TransformerAbstract;

class ResignationTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Resignation $resignation)
    {
        return [
            'employee_name' => $resignation->employee->full_name,
            'noticed_at' => $resignation->noticed_at->format('d M Y (H:i)'),
            'resigned_at' => $resignation->resigned_at->format('d M Y (H:i)'),
            'status' => $resignation->getStatusHtml(),
            'actions' => view('partials.resignation.table-action', compact('resignation'))->render(),
        ];
    }
}
