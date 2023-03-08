@extends('layouts.main', ['title' => 'Create new document'])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <style>
        textarea {
            height: 70px !important;
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
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create new document</h4>
                        </div>
                        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                    <select class="form-control" name="employee_id" id="employee">
                                    </select>
                                </div>

                                <hr>

                                <div id="parent">
                                    <div class="files" id="files-1">
                                        <div class="form-group">
                                            <label>Document Name <span class="text-danger"><strong>*</strong></span></label>
                                            <input type="text" class="form-control" placeholder="KTP" name="name[]"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>Name <span class="text-danger"><strong>*</strong></span></label>
                                            <input type="file" class="form-control" name="document[]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-success mr-1" id="btnAdd" type="button">Add more file</button>
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
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
            $("#employee").select2({
                placeholder: 'Employee...',
                allowClear: true,
                ajax: {
                    url: "{{ route('ajax.employees.getEmployees') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });

            $('#btnAdd').click(function() {
                var idNewFile = $('.files').length + 1;
                var txt1 = `<div class="files" id="files-${idNewFile}">
                            <hr>
                                <div class="form-group">
                                    <label>Document Name <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" placeholder="KTP" name="name[]"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Name <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="file" class="form-control" name="document[]" required>
                                </div>

                                <div class="text-right">
                                    <button class="btn btn-danger mr-1 remove" data-id='${idNewFile}' type="button">Remove</button>
                                </div>
                            </div>`;
                $(".files").last().after(txt1);
            });

            $('#parent').on('click', '.remove', function() {
                var id = $(this).data("id");
                $('#files-' + id).remove();
            });
        });
    </script>
@endpush
