@extends('layouts.main', ['title' => 'Edit employee'])

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/cropper.min.css') }}">
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
        <h1>Employee</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit employee</h4>
                    </div>
                    <form action="" method="POST" id="formEmployee" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nomor Induk Kependudukan <span class="text-danger"><strong>*</strong></span></label>
                                <input type="number" class="form-control" placeholder="1371016902570005" name="nik" value="{{$employee->nik}}" required>
                            </div>
                            <div class="form-group">
                                <label>Name <span class="text-danger"><strong>*</strong></span></label>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="First name" name="first_name" value="{{$employee->first_name}}" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Last name" name="last_name" value="{{$employee->last_name}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date of Birth <span class="text-danger"><strong>*</strong></span></label>
                                <input type="date" class="form-control" name="date_of_birth" value="{{Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Place of Birth <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" placeholder="Jakarta" name="place_of_birth" value="{{$employee->place_of_birth}}" required>
                            </div>
                            <div class="form-group">
                                <label>Gender <span class="text-danger"><strong>*</strong></span></label>
                                <select class="form-control" name="gender" required>
                                    <option>Select a gender</option>
                                    <option value="male" {{$employee->gender == 'male' ? 'selected':''}}>Male</option>
                                    <option value="female" {{$employee->gender == 'female' ? 'selected':''}}>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Address <span class="text-danger"><strong>*</strong></span></label>
                                <textarea type="text" class="form-control" placeholder="Jl Dukuh Kupang Brt 31, Jawa Timur" name="address" required>{{$employee->address}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Phone Number <span class="text-danger"><strong>*</strong></span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control phone-number" name="phone" value="{{$employee->phone}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Religion <span class="text-danger"><strong>*</strong></span></label>
                                <input type="text" class="form-control" name="religion" value="{{$employee->religion}}" required>
                            </div>
                            <div class="form-group">
                                <label>Avatar</label>
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ $employee->avatar_url }}" id="previewAvatar" class="img-thumbnail ava-thumbnail">
                                    </div>
                                </div>
                                <input type="file" class="form-control" name="avatar" id="selectAvatar">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$employee->user->email}}" disabled>
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

@include('modals.employee.edit_image')

@endsection

@push('js')
<script src="{{ asset('assets/js/cleave/cleave.min.js') }}"></script>
<script src="{{ asset('assets/js/cleave/addons/cleave-phone.id.js') }}"></script>
<script src="{{ asset('assets/js/cropperjs/cropper.min.js') }}"></script>
<script>
    jQuery(function() {
        var cleavePN = new Cleave('.phone-number', {
            phone: true,
            phoneRegionCode: 'id'
        });
    });
</script>
@endpush