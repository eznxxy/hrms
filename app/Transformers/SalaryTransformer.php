<?php

namespace App\Transformers;

use App\Models\Salary;
use League\Fractal\TransformerAbstract;

class SalaryTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Salary $salary)
    {
        return [
            'id' => $salary->id,
            'position_name' => $salary->position->name,
            'nominal' => \App\Helpers\PriceHelper::format($salary->nominal),
            'created_at' => $salary->created_at->format('d M Y (H:i)'),
            'updated_at' => $salary->updated_at->format('d M Y (H:i)'),
            'actions' => view('partials.salary.table-action', compact('salary'))->render(),
        ];
    }
}
