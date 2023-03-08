<div class="buttons">
    <a href="{{ route('employees.show', $employee->id) }}"><button class="btn-sm btn-icon btn-success edit"><i class="fas fa-eye"></i></button></a>
    <a href="{{ route('employees.edit', $employee->id) }}"><button class="btn-sm btn-icon btn-primary edit"><i class="far fa-edit"></i></button></a>
    @if (Auth::user()->role->name == 'admin')
    <button type="button" class="btn-sm btn-icon btn-danger delete" data-employee="{{$employee->id}}" data-url="{{ route('ajax.employees.destroy', $employee->id) }}"><i class="fas fa-times"></i></button>
    @endif
</div>
