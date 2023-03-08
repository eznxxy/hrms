<?php

namespace App\Transformers;

use App\Models\Position;
use League\Fractal\TransformerAbstract;

class PositionTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Position $position)
    {
        return [
            'division_name' => $position->division->name,
            'code' => $position->code,
            'name' => $position->name,
            'created_at' => $position->created_at->format('d M Y (H:i)'),
            'updated_at' => $position->updated_at->format('d M Y (H:i)'),
            'actions' => view('partials.position.table-action', compact('position'))->render(),
        ];
    }
}
