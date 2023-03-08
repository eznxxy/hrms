@extends('layouts.main', ['title' => 'Dashboard'])

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/cropper.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/chocolat.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/summernote-bs4.css') }}">
<style>
    textarea {
        height: 70px !important;
    }

    .pointer {
        cursor: pointer;
    }

    .quotes-by {
        margin-top: -25px;
        font-size: 14px;
    }
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    @if (Auth::user()->role_id != 3)
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('employees.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Employee Active</h4>
                        </div>
                        <div class="card-body">
                            {{$employees->where('status', 'active')->count()}}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('employees.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Employee Inactive</h4>
                        </div>
                        <div class="card-body">
                            {{$employees->where('status', 'inactive')->count()}}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('announcements.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Announcements</h4>
                        </div>
                        <div class="card-body">
                            {{$announcements->count()}}
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endif
    @if (Auth::user()->role_id == 3)
    <div class="row">
        <div class="col-12 mb-4">
            <div class="hero bg-primary text-white">
                <div class="hero-inner">
                    <h2>Welcome Back, {{Auth::user()->first_name}}!</h2>
                    <p class="lead font-weight-bold">"Be steady and well-ordered in your life so that you can be fierce and original in your work."</p><br>
                    <p class="quotes-by">– Gustave Flaubert, Writer</p>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pinned Announcement</h4>
                </div>
                <div class="card-body">
                    <textarea type="text" class="pinned_announcement" id="pinned_announcement">{{ $announcements->where('is_pinned', true)->first()->description ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="{{ Auth::user()->role_id != 3 ? 'col-lg-8 col-md-12 col-12 col-sm-12' : 'col-lg-12 col-md-12 col-12 col-sm-12' }}">
            <div class="card">
                <form method="" id="formProfiles">
                    <div class="card-header">
                        <h4>Company Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <div class="mb-2 text-muted"></div>
                                <div class="chocolat-parent">
                                    <div data-crop-image="285">
                                        <a href="{{ $profile->logo_url }}" class="chocolat-image" title="Just an example">
                                            <img alt="image" src="{{ $profile->logo_url }}" style="height: 100%; width: 100%; object-fit: contain" id="previewLogo" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                                @if (Auth::user()->role_id != 3)
                                <label class="btn btn-primary btn-block pointer">
                                    <span class="text-white">Change Logo</span>
                                    <input type="file" style="display:none" name="logo" id="selectLogo">
                                </label>
                                @endif
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" name="company_name" class="form-control" value="{{ $profile->company_name }}" {{ Auth::user()->role_id != 3 ? '' : 'readonly' }}>
                                </div>
                                <div class="form-group">
                                    <label>Chief</label>
                                    <input type="text" name="chief" class="form-control" value="{{ $profile->chief }}" {{ Auth::user()->role_id != 3 ? '' : 'readonly' }}>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number <span class="text-danger"><strong>*</strong></span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                +{{$profile->phonecode}}
                                            </div>
                                        </div>
                                        <input type="number" name="phone" class="form-control phone-number" name="phone" value="{{ $profile->phone }}" {{ Auth::user()->role_id != 3 ? '' : 'readonly' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-12">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $profile->email }}" {{ Auth::user()->role_id != 3 ? '' : 'readonly' }}>
                            </div>
                            <div class="form-group col-md-3 col-12">
                                <label>Telephone</label>
                                <input type="number" name="telp" class="form-control" value="{{ $profile->telp ?? '-' }}" {{ Auth::user()->role_id != 3 ? '' : 'readonly' }}>
                            </div>
                            <div class="form-group col-md-3 col-12">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="{{ $profile->city }}" {{ Auth::user()->role_id != 3 ? '' : 'readonly' }}>
                            </div>
                            <div class="form-group col-md-2 col-12">
                                <label>Zip Code</label>
                                <input type="number" name="zip_code" class="form-control" value="{{ $profile->zip_code }}" {{ Auth::user()->role_id != 3 ? '' : 'readonly' }}>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Address 1</label>
                                <textarea class="form-control" name="address1" {{ Auth::user()->role_id != 3 ? '' : 'readonly' }}>{{ $profile->address1 }}</textarea>
                            </div>
                            <div class="form-group col-12">
                                <label>Address 2</label>
                                <textarea class="form-control" name="address2" {{ Auth::user()->role_id != 3 ? '' : 'readonly' }}>{{ $profile->address2 ?? '-' }}</textarea>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->role_id != 3)
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="button" id="updateProfile">Save Changes</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
        @if (Auth::user()->role_id != 3)
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Recent Structurals</h4>
                </div>
                <div class="card-body">
                    <div class="activities">
                        @foreach ($structurals as $history_position)
                        <div class="activity">
                            <div class="activity-icon bg-primary text-white shadow-primary">
                                {!! $history_position->code == 'new'
                                ? '<i class="fas fa-comment-alt"></i>'
                                : ($history_position->code == 'promoted'
                                ? '<i class="fas fa-arrow-up"></i>'
                                : '<i class="fas fa-arrow-down"></i>') !!}
                            </div>
                            <div class="activity-detail">
                                <div class="mb-2">
                                    <span class="text-job text-primary">{{ $history_position->created_at->diffForHumans() }}</span>
                                    <span class="bullet"></span>
                                    <span class="text-job">{{ $history_position->status }}</span>
                                </div>
                                <p><a href="{{ route('employees.show', $history_position->employee->id) }}">{{ $history_position->employee->full_name }}</a>
                                    has been
                                    {{ $history_position->code == 'new' ? 'assigned' : ($history_position->code == 'promoted' ? 'promoted' : 'demoted') }}
                                    to new position as <span class="text-primary">{{ $history_position->position->name }}</span>.
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center pt-1 pb-1">
                        <a href="{{ route('structurals.create') }}" class="btn btn-primary btn-lg btn-round">
                            View All
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @if (Auth::user()->role_id != 3)
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Latest Resignation</h4>
                    <div class="card-header-action">
                        <a href="{{ route('resignations.index') }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="resignationTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Employee Name</th>
                                    <th>Noticed at</th>
                                    <th>Resigned at</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
</section>
@include('modals.profile.edit_logo')
@endsection

@push('js')
<script src="{{ asset('assets/js/chocolat/jquery.chocolat.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/cropperjs/cropper.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.pinned_announcement').summernote('disable');
    });

    jQuery(function() {
        var resignationTable = $('#resignationTable').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: "{{ route('ajax.resignations.index', ['type' => 'dashboard']) }}",
            columns: [{
                    "data": "id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'employee_name',
                    name: 'employee_name'
                },
                {
                    data: 'noticed_at',
                    name: 'noticed_at'
                },
                {
                    data: 'resigned_at',
                    name: 'resigned_at'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    searchable: false,
                    sortable: false
                },
            ]
        });

        const deleteResignation = (url) => {
            $.ajax({
                url: url,
                method: 'DELETE',
                success: function(response) {

                    swal(response.message, {
                        icon: 'success',
                    });

                    resignationTable.ajax.reload();
                },
                error: function(xhr) {
                    ResponseHelper.handle(xhr);
                }
            });
        }

        const updateProfile = () => {
            var formArray = $('#formProfiles :not(.not_included)').serializeArray();
            $.ajax({
                method: 'POST',
                url: "{{ route('ajax.profiles.update', 1) }}",
                data: formArray,
                beforeSend: function() {
                    $('#updateProfile').prop('disabled', true);
                    $('#updateProfile').addClass('btn-progress');
                },
                success: function(response) {
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    }).then(() => {
                        $('#updateProfile').removeClass('btn-progress');
                        $('#updateProfile').prop('disabled', false);

                        location.reload();
                    });
                },
                error: function(xhr) {
                    $('#updateProfile').removeClass('btn-progress');
                    $('#updateProfile').prop('disabled', false);

                    ResponseHelper.handle(xhr);
                }
            });
        }

        $('#resignationTable').on('click', '.delete', function() {
            var url = $(this).data('url');

            swal({
                    title: 'Are you sure?',
                    text: 'Once deleted, you will not be able to recover this data!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        deleteResignation(url);
                    }
                });
        });

        $('#updateProfile').on('click', function() {
            swal({
                    title: 'Update Company Profile ',
                    text: 'Are you sure want to update this company profile?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((update) => {
                    if (update) {
                        updateProfile();
                    }
                });
        });
    });
</script>
@endpush