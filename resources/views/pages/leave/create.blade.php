@extends('layouts.main', ['title' => 'Create new leave'])

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
        <h1>Leave</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('leaves.index') }}">Leave</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>New Leave</h4>
                    </div>
                    <form action="{{ route('leaves.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" value="{{ Auth::user()->employee->full_name }}" readonly required>
                                <input type="hidden" name="employee_id" value="{{ Auth::user()->employee->id }}">
                            </div>
                            <div class="form-group">
                                <label>Category <span class="text-danger"><strong>*</strong></span></label>
                                <select class="form-control" name="leave_category_id" id="category" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Start at <span class="text-danger"><strong>*</strong></span></label>
                                <input type="date" class="form-control" name="start_at" required>
                            </div>
                            <div class="form-group">
                                <label>End at <span class="text-danger"><strong>*</strong></span></label>
                                <input type="date" class="form-control" name="end_at" required>
                            </div>
                            <div class="form-group">
                                <label>Description <span class="text-danger"><strong>*</strong></span></label>
                                <textarea type="text" class="form-control" placeholder="Mengundurkan diri karena ...." name="description" required></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
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
        $("#category").select2({
            placeholder: 'Category...',
            allowClear: true,
            ajax: {
                url: "{{ route('ajax.leave_categories.get_categories') }}",
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
    });
</script>
@endpush