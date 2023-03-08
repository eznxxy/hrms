@extends('layouts.main', ['title' => 'Edit incentive'])

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
        <h1>Incentive</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('incentives.index') }}">Incentive</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit salary</h4>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data" id="formIncentive">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" value="{{ $incentive->employee->full_name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Incentive Name <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" value="{{ $incentive->name }}" name="name">
                            </div>
                            <div class="form-group">
                                <label>Nominal <span class="text-danger"><strong>*</strong></span></label>
                                <input type="number" class="form-control" placeholder="1000000" name="nominal" value="{{ round($incentive->nominal) }}" required>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="button" id="btnSubmit">Submit</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script>
    $('#btnSubmit').click(function() {
        var formArray = $('#formIncentive').serializeArray();
        $.ajax({
            method: 'POST',
            url: "{{ route('ajax.incentives.update', $incentive->id) }}",
            data: formArray,
            beforeSend: function() {
                $('#btnSubmit').prop('disabled', true);
                $('#btnSubmit').addClass('btn-progress');
            },
            success: function(response) {
                swal({
                    title: "Success!",
                    text: response.message,
                    icon: "success",
                }).then(() => {
                    $('#btnSubmit').removeClass('btn-progress');
                    $('#btnSubmit').prop('disabled', false);

                    window.location = "{{ route('incentives.index') }}";
                });
            },
            error: function(xhr) {
                $('#btnSubmit').removeClass('btn-progress');
                $('#btnSubmit').prop('disabled', false);

                ResponseHelper.handle(xhr);
            }
        });
    });
</script>
@endpush