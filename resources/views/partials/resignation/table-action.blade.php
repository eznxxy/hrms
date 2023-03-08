<div class="buttons">
    <a href="{{ route('resignations.show', $resignation->id) }}"><button class="btn-sm btn-icon btn-success"><i class="far fa-eye"></i></button></a>
    <a href="{{ route('resignations.edit', $resignation->id) }}"><button class="btn-sm btn-icon btn-primary edit"><i class="far fa-edit"></i></button></a>
    @if (Auth::user()->role->name == 'admin')
    <button type="button" class="btn-sm btn-icon btn-danger delete" data-resignation="{{$resignation->id}}" data-url="{{ route('ajax.resignations.destroy', $resignation->id) }}"><i class="fas fa-times"></i></button>
    @endif
</div>