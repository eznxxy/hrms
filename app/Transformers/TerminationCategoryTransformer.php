<?php

namespace App\Transformers;

use App\Models\TerminationCategory;
use League\Fractal\TransformerAbstract;

class TerminationCategoryTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(TerminationCategory $termination_category)
    {
        return [
            'name' => $termination_category->name,
            'created_at' => $termination_category->created_at->format('d M Y (H:i)'),
            'updated_at' => $termination_category->updated_at->format('d M Y (H:i)'),
            'actions' => view('partials.termination_category.table-action', compact('termination_category'))->render(),
        ];
    }
}
