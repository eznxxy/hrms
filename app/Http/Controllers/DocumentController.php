<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        return view('pages.document.index');
    }

    public function create()
    {
        return view('pages.document.create');
    }

    public function store(StoreDocumentRequest $request)
    {
        $data = $request->validated();
        $document = new Document();

        foreach ($data['name'] as $key => $value) {
            if (!$data['document'][$key]->storePublicly($document->getDocumentPath(), ['disk' => 'public'])) {
                abort(500, __("File couldn't be saved, please try again"));
            }

            $document = Document::create([
                'employee_id' => $data['employee_id'],
                'name' => $value,
                'document' => $data['document'][$key]->hashName(),
            ]);
        }

        return redirect()->route('documents.index')->with('success', __('Documents has been successfully added'));
    }
}
