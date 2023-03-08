<div class="buttons">
    <a href="{{ route('terminations.show', $termination->id) }}"><button class="btn-sm btn-icon btn-success"><i class="far fa-eye"></i></button></a>
    <a href="{{ route('terminations.edit', $termination->id) }}"><button class="btn-sm btn-icon btn-primary edit"><i class="far fa-edit"></i></button></a>
    @if(Auth::user()->role->name == 'admin')
    <button type="button" class="btn-sm btn-icon btn-danger delete" data-document="{{$termination->id}}" data-url="{{ route('ajax.terminations.destroy', $termination->id) }}"><i class="fas fa-times"></i></button>
    @endif
</div>
