@extends('layouts.main', ['title' => 'Create new position'])

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
        <h1>Position</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('positions.index') }}">Position</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create new position</h4>
                    </div>
                    <form action="{{ route('positions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Division <span class="text-danger"><strong>*</strong></span></label>
                                <select class="form-control select2" name="division_id" id="division">
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Name <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" placeholder="Growth" name="name" required>
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
            $('#division').select2();
        });
</script>
@endpush