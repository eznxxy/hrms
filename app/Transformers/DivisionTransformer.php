<?php

namespace App\Transformers;

use App\Models\Division;
use League\Fractal\TransformerAbstract;

class DivisionTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Division $division)
    {
        return [
            'code' => $division->code,
            'name' => $division->name,
            'created_at' => $division->created_at->format('d M Y (H:i)'),
            'updated_at' => $division->updated_at->format('d M Y (H:i)'),
            'actions' => view('partials.division.table-action', compact('division'))->render(),
        ];
    }
}
