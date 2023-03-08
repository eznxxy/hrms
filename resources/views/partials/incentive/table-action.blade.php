<div class="buttons">
    @if (Auth::user()->role->name != 'employee')
    <a href="{{ route('incentives.edit', $incentive->id) }}"><button class="btn-sm btn-icon btn-primary edit"><i class="far fa-edit"></i></button></a>
    <button type="button" class="btn-sm btn-icon btn-danger delete" data-incentive="{{$incentive->id}}" data-url="{{ route('ajax.incentives.destroy', $incentive->id) }}"><i class="fas fa-times"></i></button>
    @endif
</div>