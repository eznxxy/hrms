<?php

namespace App\Transformers;

use App\Models\Incentive;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class IncentiveTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Incentive $incentive)
    {
        return [
            'id' => $incentive->id,
            'employee_name' => $incentive->employee->full_name,
            'name' => $incentive->name,
            'nominal' => \App\Helpers\PriceHelper::format($incentive->nominal),
            'status' => $incentive->getStatusHtml(),
            'created_at' => $incentive->created_at->format('d M Y (H:i)'),
            'updated_at' => $incentive->updated_at->format('d M Y (H:i)'),
            'actions' => Auth::user()->role->name != 'employee' ? view('partials.incentive.table-action', compact('incentive'))->render() : '-',
        ];
    }
}
