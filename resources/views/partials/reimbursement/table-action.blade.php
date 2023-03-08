<div class="buttons">
    <a href="{{ route('reimbursements.show', $reimbursement->id) }}"><button class="btn-sm btn-icon btn-success"><i class="far fa-eye"></i></button></a>
    @if (Auth::user()->role->id != 1 && $reimbursement->employee_id == Auth::user()->employee->id)
    <a href="{{ route('reimbursements.edit', $reimbursement->id) }}"><button class="btn-sm btn-icon btn-primary edit"><i class="far fa-edit"></i></button></a>
    @endif
    @if (Auth::user()->role->name == 'admin')
    <button type="button" class="btn-sm btn-icon btn-danger delete" data-incentive="{{$reimbursement->id}}" data-url="{{ route('ajax.reimbursements.destroy', $reimbursement->id) }}"><i class="fas fa-times"></i></button>
    @endif
</div>
