@extends('layouts.main', ['title' => 'Edit position'])

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
            <h1>Position</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('positions.index') }}">Position</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit position</h4>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data" id="formPosition">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Division <span class="text-danger"><strong>*</strong></span></label>
                                    <select class="form-control select2" name="division_id" id="division">
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}" {{ $position->division_id == $division->id ? 'selected':'' }}>{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" placeholder="QA" name="name"
                                        value="{{ $position->name }}" required>
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
        $(document).ready(function() {
            $('#division').select2();
        });

        $('#btnSubmit').click(function() {
            var formArray = $('#formPosition').serializeArray();
            $.ajax({
                method: 'POST',
                url: "{{ route('ajax.positions.update', $position->id) }}",
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

                        window.location = "{{ route('positions.index') }}";
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
