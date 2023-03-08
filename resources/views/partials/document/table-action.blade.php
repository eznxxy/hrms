<div class="buttons">
    <a href="{{$document->document_url}}" target="_blank"><button class="btn-sm btn-icon btn-primary"><i class="far fa-eye"></i></button></a>
    <button type="button" class="btn-sm btn-icon {{ isset(Auth::user()->employee->id) ? (Auth::user()->employee->id != $document->employee_id ? 'btn-danger':'btn-secondary'):'btn-danger' }} delete" data-document="{{$document->id}}" data-url="{{ route('ajax.documents.destroy', $document->id) }}" {{ isset(Auth::user()->employee->id) ? (Auth::user()->employee->id != $document->employee_id ? '':'disabled'):'' }}><i class="fas fa-times"></i></button>
</div>
