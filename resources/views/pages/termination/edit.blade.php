@extends('layouts.main', ['title' => 'Edit termination'])

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
            <h1>Termination</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('divisions.index') }}">Termination</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit termination</h4>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data" id="formTermination">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" name="employee_id" id="employee"
                                        value="{{ $termination->employee->full_name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Category <span class="text-danger"><strong>*</strong></span></label>
                                    <select class="form-control" name="termination_category_id" id="category" required>
                                        @foreach ($termination_categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $termination->termination_category->id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Notice at <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="date" class="form-control" name="noticed_at"
                                        value="{{ Carbon\Carbon::parse($termination->noticed_at)->format('Y-m-d') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Terminate at <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="date" class="form-control" name="terminated_at"
                                        value="{{ Carbon\Carbon::parse($termination->terminated_at)->format('Y-m-d') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Description <span class="text-danger"><strong>*</strong></span></label>
                                    <textarea type="text" class="form-control" placeholder="Diberhentikan karena ...." name="description" required>{{ $termination->description }}</textarea>
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
                var formArray = $('#formTermination').serializeArray();
                $.ajax({
                    method: 'POST',
                    url: "{{ route('ajax.terminations.update', $termination->id) }}",
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

                            window.location = "{{ route('terminations.index') }}";
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
