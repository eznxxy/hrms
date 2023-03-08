@extends('layouts.main', ['title' => 'Edit reimbursement'])

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
        <h1>Reimbursement</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('reimbursements.index') }}">Reimbursement</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Reimbursement</h4>
                    </div>
                    <form action="{{ route('reimbursements.update', $reimbursement->id) }}" method="POST" enctype="multipart/form-data" id="formReimbursement">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" value="{{ $reimbursement->employee->full_name }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Reimbursement Name <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" placeholder="Bensin" value="{{ $reimbursement->name }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Nominal <span class="text-danger"><strong>*</strong></span></label>
                                <input type="number" class="form-control" placeholder="1000000" value="{{ (int)$reimbursement->nominal }}" name="nominal" required>
                            </div>

                            <div class="form-group">
                                <label>Attachment Image </label>
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit" id="btnSubmit">Submit</button>
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
    //
</script>
@endpush