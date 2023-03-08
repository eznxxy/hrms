<div class="buttons">
    <a href="{{ route('positions.edit', $position->id) }}"><button class="btn-sm btn-icon btn-primary edit"><i class="far fa-edit"></i></button></a>
    <button type="button" class="btn-sm btn-icon btn-danger delete" data-position="{{$position->id}}" data-url="{{ route('ajax.positions.destroy', $position->id) }}"><i class="fas fa-times"></i></button>
</div>
