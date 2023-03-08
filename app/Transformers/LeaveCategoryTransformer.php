<?php

namespace App\Transformers;

use App\Models\LeaveCategory;
use League\Fractal\TransformerAbstract;

class LeaveCategoryTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(LeaveCategory $leave_category)
    {
        return [
            'name' => $leave_category->name,
            'created_at' => $leave_category->created_at->format('d M Y (H:i)'),
            'updated_at' => $leave_category->updated_at->format('d M Y (H:i)'),
            'actions' => view('partials.leave_category.table-action', compact('leave_category'))->render(),
        ];
    }
}
