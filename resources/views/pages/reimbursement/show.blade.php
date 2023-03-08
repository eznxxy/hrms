@extends('layouts.main', ['title' => 'Detail reimbursement'])

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<style>
    textarea {
        height: 70px !important;
    }

    .ava-thumbnail {
        max-width: 150px !important;
        margin-bottom: 10px;
    }
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Reimbursement</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('reimbursements.index') }}">Reimbursement</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Resignation</h4>
                        <div style="margin-left: auto;">
                            {!! $reimbursement->getStatusHtml() !!}
                        </div>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" value="{{ $reimbursement->employee->full_name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Reimbursement Name <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" value="{{ $reimbursement->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nominal <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" value="{{ \App\Helpers\PriceHelper::format($reimbursement->nominal) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Attachment</label>
                                <button type="button" id="btnShowImage" class="form-control btn btn-success mr-1">Show Image</button>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            @if ((Auth::user()->role->name == 'hr' && $reimbursement->employee_id != Auth::user()->employee->id) || Auth::user()->role->name == 'admin')
                            <button type="button" data-status="paid" id="btnPaid" class="btnUpdateStatus btn btn-success mr-1" {{($reimbursement->status != 'pending') ? 'disabled':''}}>Paid</button>
                            <button type="button" data-status="declined" id="btndecline" class="btnUpdateStatus btn btn-danger mr-1" {{($reimbursement->status != 'pending') ? 'disabled':''}}>Decline</button>
                            @endif
                            <a href="{{ route('reimbursements.index') }}" class="btn btn-primary mr-1">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('modals.reimbursement.show_image')
@endsection

@push('js')
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#btnShowImage').click(function() {
            $('#showImageAttachmentModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#srcImage').attr('src', '{{$reimbursement->image_url}}');
        });

        $('.btnUpdateStatus').click(function() {
            let status = $(this).data("status");

            swal({
                    title: 'Are you sure?',
                    text: `Once ${status}, you will not be able to undo this action!`,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('ajax.reimbursements.update_status', $reimbursement->id) }}",
                            data: {
                                status: status
                            },
                            success: function(response) {
                                swal({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success",
                                }).then(() => {
                                    window.location = "{{ route('reimbursements.index') }}";
                                });
                            },
                            error: function(xhr) {
                                ResponseHelper.handle(xhr);
                            }
                        });
                    }
                });
        });
    });
</script>
@endpush