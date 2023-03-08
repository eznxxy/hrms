@extends('layouts.main', ['title' => 'Detail Employee'])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <style>
        .fake-href {
            color: #6777ef;
            font-weight: 600;
        }

        .btn-assign-position {
            color: #6777ef;
            padding: 0px;
        }

        .btn-assign-position:hover {
            color: #001eff;
            padding: 0px;
        }

        textarea {
            height: 70px !important;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Employee</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee</a></div>
                <div class="breadcrumb-item">Detail</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="family-tab" data-toggle="tab" href="#family" role="tab"
                                aria-controls="family" aria-selected="false">Family</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                                aria-controls="contact" aria-selected="false">Structurals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="document-tab" data-toggle="tab" href="#document" role="tab"
                                aria-controls="contact" aria-selected="false">Documents</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="myTabContent2">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-left">
                                <img alt="image" src="{{ $employee->avatar_url }}"
                                    class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <a href="#" class="btn btn-primary mt-3 follow-btn"
                                    data-follow-action="alert('follow clicked');"
                                    data-unfollow-action="alert('unfollow clicked');">Follow</a>
                            </div>
                            <div class="author-box-details">
                                <div class="author-box-name">
                                    <span class="fake-href">{{ $employee->full_name }}</span>
                                </div>
                                <div class="author-box-job">
                                    <span>{!! $structural->position->name ??
                                        'This employee doesnt have position, please assign a position by clicking <button id="btnAssign" class="btn btn-assign-position btnAssign">here</button>' !!}</span>
                                </div>
                                <hr>
                                <div class="author-box-description">
                                    <div class="form-group">
                                        <label>Nomor Induk Kependudukan</label>
                                        <input type="number" class="form-control" value="{{ $employee->nik }}"
                                            name="nik" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->first_name }}" name="first_name" readonly>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->last_name }}" name="last_name" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="text" class="form-control" name="date_of_birth"
                                            value="{{ Carbon\Carbon::parse($employee->date_of_birth)->format('d F Y') }}"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Place of Birth</label>
                                        <input type="text" class="form-control" value="{{ $employee->place_of_birth }}"
                                            name="place_of_birth" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <input type="text" class="form-control"
                                            value="{{ ucfirst($employee->gender) }}" name="gender" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea type="text" class="form-control" placeholder="Jl Dukuh Kupang Brt 31, Jawa Timur" name="address"
                                            readonly>{{ $employee->address }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control phone-number" name="phone"
                                                value="{{ $employee->phone }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <input type="text" class="form-control" name="religion"
                                            value="{{ $employee->religion }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $employee->user->email }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-2 mt-3">
                                    <div class="text-small font-weight-bold">Contact <span>{{ $employee->full_name }}</span> On</div>
                                </div>
                                <a href="https://wa.me/+62{{ (int)str_replace(' ', '', $employee->phone) }}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                        <path
                                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            @if ($employee->family != null)
                                <div class="author-box-left">
                                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                        class="rounded-circle author-box-picture">
                                    <div class="clearfix"></div>
                                    <a href="#" class="btn btn-primary mt-3 follow-btn"
                                        data-follow-action="alert('follow clicked');"
                                        data-unfollow-action="alert('unfollow clicked');">Follow</a>
                                </div>
                                <div class="author-box-details">
                                    <div class="author-box-name">
                                        <span class="fake-href">{{ $employee->family->full_name }}</span>
                                    </div>
                                    <div class="author-box-job">{{ $employee->family->job }}</div>
                                    <div class="author-box-description">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        value="{{ $employee->family->first_name }}" name="first_name"
                                                        readonly>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                        value="{{ $employee->family->last_name }}" name="last_name"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="text" class="form-control" name="date_of_birth"
                                                value="{{ Carbon\Carbon::parse($employee->family->date_of_birth)->format('d F Y') }}"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Job</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->family->job }}" name="job" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea type="text" class="form-control" placeholder="Jl Dukuh Kupang Brt 31, Jawa Timur" name="address"
                                                readonly>{{ $employee->address }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Number of Children</label>
                                            <input type="text" class="form-control" name="number_of_children"
                                                value="{{ $employee->family->number_of_children }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control phone-number" name="phone"
                                                    value="{{ $employee->family->phone }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 mt-3">
                                        <div class="text-small font-weight-bold">Contact
                                            {{ $employee->family->full_name }} On</div>
                                    </div>
                                    <a href="https://wa.me/+{{ $employee->family->phonecode . (int) $employee->family->phone }}"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                            <path
                                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                        </svg>
                                    </a>
                                </div>
                            @else
                                <div class="empty-state" data-height="400" id="noFamily">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <h2>We couldn't find any data</h2>
                                    <p class="lead">
                                        Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                                    </p>
                                    <button type="button" id="btnAddFamily" class="btn btn-primary mt-4">Create new
                                        One</a>
                                </div>
                            @endif

                            <div id="newFamily" style="display: none">
                                <div class="author-box-left">
                                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                        class="rounded-circle author-box-picture">
                                    <div class="clearfix"></div>
                                    <a href="#" class="btn btn-primary mt-3 follow-btn"
                                        data-follow-action="alert('follow clicked');"
                                        data-unfollow-action="alert('unfollow clicked');">Follow</a>
                                </div>
                                <div class="author-box-details">
                                    <div class="author-box-name">
                                        <span class="fake-href" id="headName">Full Name</span>
                                    </div>
                                    <div class="author-box-job" id="headJob">Job</div>
                                    <div class="author-box-description">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" id="first_name"
                                                        value="" name="first_name" readonly>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="last_name"
                                                        value="" name="last_name" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="text" class="form-control" id="date_of_birth"
                                                name="date_of_birth" value="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Job</label>
                                            <input type="text" class="form-control" id="job" value=""
                                                name="job" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea type="text" class="form-control" id="address" placeholder="Jl Dukuh Kupang Brt 31, Jawa Timur"
                                                name="address" readonly></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Number of Children</label>
                                            <input type="text" class="form-control" id="number_of_children"
                                                name="number_of_children" value="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control phone-number" id="phone"
                                                    name="phone" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 mt-3">
                                        <div class="text-small font-weight-bold">Contact <span id="contact_name">Full
                                                Name</span> On</div>
                                    </div>
                                    <a href="#" target="_blank" id="whatsapp">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                            <path
                                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                    <div class="row">
                        <div class="col-12">
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
                                                <span
                                                    class="text-job text-primary">{{ $history_position->created_at->diffForHumans() }}</span>
                                                <span class="bullet"></span>
                                                <span class="text-job">{{ $history_position->status }}</span>
                                                @if ($history_position->status != 'inactive' &&
                                                    Carbon\Carbon::parse($history_position->created_at)->diffInHours(Carbon\Carbon::now()) <= 24)
                                                    <div class="float-right dropdown">
                                                        <a href="#" data-toggle="dropdown"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu">
                                                            <div class="dropdown-title">Options</div>
                                                            <a href="#" class="dropdown-item has-icon"><i
                                                                    class="fas fa-bullhorn"></i> Broadcast</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <p>Has been
                                                {{ $history_position->code == 'new' ? 'assigned' : ($history_position->code == 'promoted' ? 'promoted' : 'demoted') }}
                                                to new position as <span
                                                    class="text-primary">{{ $history_position->position->name }}</span>.
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if ($structurals->isEmpty())
                                <div class="card author-box card-primary">
                                    <div class="card-body">
                                        <div class="empty-state" data-height="400" id="noFamily">
                                            <div class="empty-state-icon">
                                                <i class="fas fa-question"></i>
                                            </div>
                                            <h2>We couldn't find any data</h2>
                                            <p class="lead">
                                                Sorry we can't find any data, to get rid of this message, please assign
                                                <span class="fake-href">{{ $employee->full_name }}</span> a position.
                                            </p>
                                            <button type="button" id="btnAssign"
                                                class="btn btn-primary mt-4 btnAssign">Assign
                                                Position</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Documents</h4>
                                    @if(Auth::user()->role->name != 'employee')
                                    <div style="margin-left: auto;">
                                        <a href="{{ route('documents.create') }}" class="btn btn-primary">New Document</a>
                                    </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="documentTable">
                                            <thead>
                                                <tr>
                                                    <th>Employee Name</th>
                                                    <th>Document Name</th>
                                                    <th>Created at</th>
                                                    <th>Updated at</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('modals.employee.add_family')
    @include('modals.employee.assign_position')
@endsection

@push('js')
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script>
        jQuery(function() {
            var documentTable = $('#documentTable').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: "{{ route('ajax.documents.index', ['employee_id' => $employee->id]) }}",
                columns: [{
                        data: 'employee_name',
                        name: 'employee_name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'actions',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            const deleteDocument = (url) => {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function(response) {

                        swal(response.message, {
                            icon: 'success',
                        });

                        documentTable.ajax.reload();
                    },
                    error: function(xhr) {
                        ResponseHelper.handle(xhr);
                    }
                });
            }

            $('#documentTable').on('click', '.delete', function() {
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
                            deleteDocument(url);
                        }
                    });
            });
        });
    </script>
@endpush
