<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentRequest;
use App\Models\Document;
use App\Transformers\DocumentTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = Document::query();

        $documents->join('employees', 'employees.id', '=', 'documents.employee_id')
            ->select(['documents.*', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) as employee_name")]);

        if (isset($request->employee_id)) {
            $documents->where('employees.id', $request->employee_id);
        }

        $resultDocument = $documents->orderBy('created_at', 'desc');

        return DataTables::of($resultDocument)
            ->filter(function ($query) use($request) {
                if (!empty(request('search.value'))) {
                    $term = request('search.value');

                    $query->where('employees.first_name', 'ilike', "%{$term}%")
                        ->orWhere('employees.last_name', 'ilike', "%{$term}%");

                    $query->where('employees.id', $request->employee_id);
                }
            })
            ->setTransformer(new DocumentTransformer)
            ->make(true);
    }

    public function destroy(Document $document)
    {
        $document->deleteDocument();
        $document->delete();

        return response()->json([
            'message' => __('Success, an a document has been deleted.')
        ]);
    }
}
