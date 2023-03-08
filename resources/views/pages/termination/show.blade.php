@extends('layouts.main', ['title' => 'Detail termination'])

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
            <h1>Detail Termination</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('divisions.index') }}">Termination</a></div>
                <div class="breadcrumb-item">Detail</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Termination</h4>
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
                                    <input type="text" class="form-control" name="employee_id" id="employee"
                                        value="{{ $termination->termination_category->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Notice at <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" name="employee_id" id="employee"
                                        value="{{ Carbon\Carbon::parse($termination->noticed_at)->format('d M Y') }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Terminate at <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" name="employee_id" id="employee"
                                        value="{{ Carbon\Carbon::parse($termination->terminated_at)->format('d M Y') }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Description <span class="text-danger"><strong>*</strong></span></label>
                                    <textarea type="text" class="form-control" placeholder="Diberhentikan karena ...." name="description" readonly>{{ $termination->description }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('terminations.index') }}" class="btn btn-primary mr-1" >Back</a>
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
            //
        });
    </script>
@endpush
