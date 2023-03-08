@extends('layouts.main', ['title' => 'Edit document'])

@push('css')
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
            <h1>Document</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('divisions.index') }}">Document</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit document</h4>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data" id="formDivision">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Code <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" placeholder="DV-GW" name="code"
                                        value="{{ $division->code }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Name <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" placeholder="Growth" name="name"
                                        value="{{ $division->name }}" required>
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
    <script>
        $('#btnSubmit').click(function() {
            var formArray = $('#formDivision').serializeArray();
            $.ajax({
                method: 'POST',
                url: "{{ route('ajax.divisions.update', $division->id) }}",
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

                        window.location = "{{ route('divisions.index') }}";
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
