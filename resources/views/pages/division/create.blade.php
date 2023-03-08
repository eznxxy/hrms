@extends('layouts.main', ['title' => 'Create new division'])

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
        <h1>Division</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('divisions.index') }}">Division</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create new division</h4>
                    </div>
                    <form action="{{ route('divisions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Code <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" placeholder="DV-GW" name="code" required>
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
<script>
    //
</script>
@endpush