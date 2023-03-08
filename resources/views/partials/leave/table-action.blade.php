<div class="buttons">
    <a href="{{ route('leaves.show', $leave->id) }}"><button class="btn-sm btn-icon btn-success"><i class="far fa-eye"></i></button></a>
    <a href="{{ route('leaves.edit', $leave->id) }}" class="{{ $leave->status != 'sent' ? 'disabled':'' }}"><button class="btn-sm btn-icon {{ $leave->status != 'sent' ? 'btn-secondary':'btn-primary' }} edit"><i class="far fa-edit"></i></button></a>
    @if (Auth::user()->role->name == 'admin')
    <button type="button" class="btn-sm btn-icon btn-danger delete" data-leave="{{$leave->id}}" data-url="{{ route('ajax.leaves.destroy', $leave->id) }}"><i class="fas fa-times"></i></button>
    @endif
</div>