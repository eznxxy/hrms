<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $guarded = [];

    public function getDocumentPath()
    {
        return 'documents/employee/';
    }

    public function hasDocument()
    {
        return $this->document && Storage::disk('public')->exists($this->getDocumentPath() . $this->document);
    }

    public function deleteDocument()
    {
        if (!$this->hasDocument()) {
            return false;
        }

        return Storage::disk('public')->delete($this->getDocumentPath() . $this->document);
    }

    public function getDocumentUrlAttribute()
    {
        if ($this->document && Storage::disk('public')->exists($this->getDocumentPath() . $this->document)) {
            $document = Storage::disk('public')->url($this->getDocumentPath() . $this->document);
        }

        return $document;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
