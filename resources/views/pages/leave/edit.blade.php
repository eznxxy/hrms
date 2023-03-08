@extends('layouts.main', ['title' => 'Edit leave'])

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
        <h1>Leave</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('leaves.index') }}">Leave</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit leave</h4>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data" id="formLeave">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" value="{{ $leave->employee->full_name }}" readonly required>
                                <input type="hidden" name="employee_id" value="{{ $leave->employee->id }}">
                            </div>
                            <div class="form-group">
                                <label>Category <span class="text-danger"><strong>*</strong></span></label>
                                <select class="form-control" name="leave_category_id" id="category" required>
                                    @foreach ($leave_categories as $category)
                                    <option value="{{ $category->id }}" {{ $leave->leave_category->id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Start at <span class="text-danger"><strong>*</strong></span></label>
                                <input type="date" class="form-control" name="start_at" value="{{ Carbon\Carbon::parse($leave->start_at)->format('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <label>End at <span class="text-danger"><strong>*</strong></span></label>
                                <input type="date" class="form-control" name="end_at" value="{{ Carbon\Carbon::parse($leave->end_at)->format('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Description <span class="text-danger"><strong>*</strong></span></label>
                                <textarea type="text" class="form-control" placeholder="Diberhentikan karena ...." name="description" required>{{ $leave->description }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" id="btnSubmit" type="button">Submit</button>
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
    $(document).ready(function() {
        $('#category').select2();

        $('#btnSubmit').click(function() {
            var formArray = $('#formLeave').serializeArray();
            $.ajax({
                method: 'POST',
                url: "{{ route('ajax.leaves.update', $leave->id) }}",
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

                        window.location = "{{ route('leaves.index') }}";
                    });
                },
                error: function(xhr) {
                    $('#btnSubmit').removeClass('btn-progress');
                    $('#btnSubmit').prop('disabled', false);

                    ResponseHelper.handle(xhr);
                }
            });
        });
    });
</script>
@endpush