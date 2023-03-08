<?php

namespace App\Transformers;

use App\Models\Termination;
use League\Fractal\TransformerAbstract;

class TerminationTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Termination $termination)
    {
        return [
            'employee_name' => $termination->employee->full_name,
            'category_name' => $termination->termination_category->name,
            'noticed_at' => $termination->noticed_at->format('d M Y (H:i)'),
            'terminated_at' => $termination->terminated_at->format('d M Y (H:i)'),
            'actions' => view('partials.termination.table-action', compact('termination'))->render(),
        ];
    }
}
