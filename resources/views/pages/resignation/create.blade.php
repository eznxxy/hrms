@extends('layouts.main', ['title' => 'Create new resignation'])

@push('css')
    <style>
        textarea {
            height: 70px !important;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Resignation</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('resignations.index') }}">Resignation</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Resign</h4>
                        </div>
                        <form action="{{ route('resignations.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control"
                                        value="{{ Auth::user()->employee->full_name }}" readonly required>
                                    <input type="hidden" name="employee_id" value="{{ Auth::user()->employee->id }}">
                                </div>
                                <div class="form-group">
                                    <label>Notice at <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="date" class="form-control" name="noticed_at" required>
                                </div>
                                <div class="form-group">
                                    <label>Resign at <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="date" class="form-control" name="resigned_at" required>
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
    <script>
        $(document).ready(function() {
            //
        });
    </script>
@endpush
