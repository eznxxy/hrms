<div class="buttons">
    <a href="{{ route('divisions.edit', $division->id) }}"><button class="btn-sm btn-icon btn-primary edit"><i class="far fa-edit"></i></button></a>
    <button type="button" class="btn-sm btn-icon btn-danger delete" data-division="{{$division->id}}" data-url="{{ route('ajax.divisions.destroy', $division->id) }}"><i class="fas fa-times"></i></button>
</div>
