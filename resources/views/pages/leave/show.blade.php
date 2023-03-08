@extends('layouts.main', ['title' => 'Detail leave'])

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
            <h1>Detail Leave</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('leaves.index') }}">Leave</a></div>
                <div class="breadcrumb-item">Detail</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Leave</h4>
                            <div style="margin-left: auto;">
                                {!! $leave->getStatusHtml() !!}
                            </div>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data" id="formTermination">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control"
                                        value="{{ $leave->employee->full_name }}" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Category <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" name="leave_id" id="leave"
                                        value="{{ $leave->leave_category->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Start at <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" name="noticed_at"
                                        value="{{ Carbon\Carbon::parse($leave->start_at)->format('d M Y') }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>End at <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" name="resigned_at"
                                        value="{{ Carbon\Carbon::parse($leave->end_at)->format('d M Y') }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Description <span class="text-danger"><strong>*</strong></span></label>
                                    <textarea type="text" class="form-control" placeholder="Diberhentikan karena ...." name="description" readonly>{{ $leave->description }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                @if ((Auth::user()->role->name == 'hr' && $leave->employee_id != Auth::user()->employee->id) || Auth::user()->role->name == 'admin')
                                    <button type="button" data-status="approved" id="btnapprove"
                                        class="btnUpdateStatus btn btn-success mr-1" {{($leave->status == 'approved') ? 'disabled':''}}>Approve</button>
                                    <button type="button" data-status="declined" id="btndecline"
                                        class="btnUpdateStatus btn btn-danger mr-1" {{($leave->status == 'declined') ? 'disabled':''}}>Decline</button>
                                @endif
                                <a href="{{ route('leaves.index') }}" class="btn btn-primary mr-1">Back</a>
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
        $(document).ready(function() {
            $('.btnUpdateStatus').click(function() {
                let status = $(this).data("status");
                $.ajax({
                    method: 'POST',
                    url: "{{ route('ajax.leaves.update_status', $leave->id) }}",
                    data: {
                        status: status
                    },
                    success: function(response) {
                        swal({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                        }).then(() => {
                            window.location = "{{ route('leaves.index') }}";
                        });
                    },
                    error: function(xhr) {
                        ResponseHelper.handle(xhr);
                    }
                });
            })
        });
    </script>
@endpush
