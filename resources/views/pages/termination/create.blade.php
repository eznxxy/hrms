@extends('layouts.main', ['title' => 'Create new termination'])

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
        <h1>Termination</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('divisions.index') }}">Termination</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create new termination</h4>
                    </div>
                    <form action="{{ route('terminations.store') }}" method="POST" enctype="multipart/form-data" id="formTermination">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                <select class="form-control" name="employee_id" id="employee" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category <span class="text-danger"><strong>*</strong></span></label>
                                <select class="form-control" name="termination_category_id" id="category" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Notice at <span class="text-danger"><strong>*</strong></span></label>
                                <input type="date" class="form-control" name="noticed_at" required>
                            </div>
                            <div class="form-group">
                                <label>Terminate at <span class="text-danger"><strong>*</strong></span></label>
                                <input type="date" class="form-control" name="terminated_at" required>
                            </div>
                            <div class="form-group">
                                <label>Description <span class="text-danger"><strong>*</strong></span></label>
                                <textarea type="text" class="form-control" placeholder="Diberhentikan karena ...." name="description" required></textarea>
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

        $("#category").select2({
            placeholder: 'Category...',
            allowClear: true,
            ajax: {
                url: "{{ route('ajax.termination_categories.get_categories') }}",
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

        $("#btnSubmit").click(function() {
            swal({
                    title: 'Are you sure?',
                    text: 'Once created, you will not be able to delete this!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((create) => {
                    if (create) {
                        $("#formTermination").submit();
                    }
                });
        });
    });
</script>
@endpush