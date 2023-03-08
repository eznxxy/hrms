@extends('layouts.main', ['title' => 'Assign position'])

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
            <h1>Structurals</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee</a></div>
                <div class="breadcrumb-item">Structural</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Assign position</h4>
                        </div>
                        <form action="{{ route('structurals.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Type <span class="text-danger"><strong>*</strong></span></label>
                                    <select class="form-control" id="type" name="code">
                                        <option value="new">New</option>
                                        <option value="promoted">Promoted</option>
                                        <option value="demoted">Demoted</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Employee Name <span class="text-danger"><strong>*</strong></span></label>
                                    <select class="form-control" name="employee_id" id="employee">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Division <span class="text-danger"><strong>*</strong></span></label>
                                    <select class="form-control" id="division">
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Position <span class="text-danger"><strong>*</strong></span></label>
                                    <select class="form-control" name="position_id" id="position">
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- //* Structural History *// --}}
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>History Structurals</h4>
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
                                                            <a href="#" id="btnBroadcast"
                                                                data-type="{{ $history_position->code }}"
                                                                data-full_name="{{ $history_position->employee->full_name }}"
                                                                data-position="{{ $history_position->position->name }}"
                                                                class="dropdown-item has-icon"><i
                                                                    class="fas fa-bullhorn"></i> Broadcast</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <p><a
                                                    href="{{ route('employees.show', $history_position->employee->id) }}">{{ $history_position->employee->full_name }}</a>
                                                has been
                                                {{ $history_position->code == 'new' ? 'assigned' : ($history_position->code == 'promoted' ? 'promoted' : 'demoted') }}
                                                to new position as <span
                                                    class="text-primary">{{ $history_position->position->name }}</span>.
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/js/cleave/cleave.min.js') }}"></script>
    <script src="{{ asset('assets/js/cleave/addons/cleave-phone.id.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            const initSelect2Position = (uri) => {
                $("#position").select2({
                    placeholder: 'Position...',
                    allowClear: true,
                    ajax: {
                        url: uri ??
                            "{{ route('ajax.positions.getPositionByDivision', ['divisionId' => '1']) }}",
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
            }

            const initSelect2Employee = (uri) => {
                $("#employee").select2({
                    placeholder: 'Employee...',
                    allowClear: true,
                    ajax: {
                        url: uri ?? "{{ route('ajax.employees.getEmployees', ['type' => 'new']) }}",
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
            }

            initSelect2Position();
            initSelect2Employee();

            $('#division').select2().on('select2:select', function(e) {
                var uri = "{{ route('ajax.positions.getPositionByDivision', ['divisionId' => 'id']) }}";
                uri = uri.replace('id', e.params.data.id);

                initSelect2Position(uri);
            });

            $('#type').select2().on('select2:select', function(e) {
                var uri = "{{ route('ajax.employees.getEmployees', ['type' => 'text']) }}";
                uri = uri.replace('text', e.params.data.id);

                initSelect2Employee(uri);
            });
        });

        jQuery(function() {
            $('#btnBroadcast').click(function() {
                let type = $(this).data("type");
                let full_name = $(this).data("full_name");
                let position = $(this).data("position");

                var uri = "{{ route('ajax.announcements.store', ['type' => 'text']) }}";
                uri = uri.replace('text', type);

                swal({
                    title: "Are you sure?",
                    text: "This will posted to Wall Magazine and all employee can see this broadcast.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willPosted) => {
                    if (willPosted) {
                        $.ajax({
                            method: 'POST',
                            url: uri,
                            data: {
                                name: full_name,
                                position: position
                            },
                            beforeSend: function() {
                                //code here
                            },
                            success: function(response) {
                                swal({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success",
                                });
                            },
                            error: function(xhr) {
                                ResponseHelper.handle(xhr);
                            }
                        });
                    } else {
                        swal("Your broadcast is canceled!");
                    }
                });
            });
        });
    </script>
@endpush
