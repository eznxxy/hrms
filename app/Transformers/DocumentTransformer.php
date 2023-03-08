<?php

namespace App\Transformers;

use App\Models\Document;
use League\Fractal\TransformerAbstract;

class DocumentTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Document $document)
    {
        return [
            'employee_name' => $document->employee->full_name,
            'name' => $document->name,
            'created_at' => $document->created_at->format('d M Y (H:i)'),
            'updated_at' => $document->updated_at->format('d M Y (H:i)'),
            'actions' => view('partials.document.table-action', compact('document'))->render(),
        ];
    }
}
