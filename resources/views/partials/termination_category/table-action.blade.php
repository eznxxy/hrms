<div class="buttons">
    <button type="button" class="btn-sm btn-icon btn-danger delete" data-termination_category="{{$termination_category->id}}" data-url="{{ route('ajax.termination_categories.destroy', $termination_category->id) }}"><i class="fas fa-times"></i></button>
</div>
