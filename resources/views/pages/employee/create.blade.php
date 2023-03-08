@extends('layouts.main', ['title' => 'Create new employee'])

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
            <h1>Employee</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create new employee</h4>
                        </div>
                        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nomor Induk Kependudukan <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="number" class="form-control" placeholder="1371016902570005" name="nik" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "16" value="{{ old('nik') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Name <span class="text-danger"><strong>*</strong></span></label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="First name"
                                                name="first_name" value="{{ old('first_name') }}" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Last name"
                                                name="last_name" value="{{ old('last_name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Date of Birth <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Place of Birth <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" placeholder="Jakarta" value="{{ old('place_of_birth') }}" name="place_of_birth"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Gender <span class="text-danger"><strong>*</strong></span></label>
                                    <select class="form-control" name="gender">
                                        <option value="male" {{ old('gender') == 'male' ? 'selected':'' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected':'' }}>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Address <span class="text-danger"><strong>*</strong></span></label>
                                    <textarea type="text" class="form-control" placeholder="Jl Dukuh Kupang Brt 31, Jawa Timur" name="address" required>{{ old('address') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number <span class="text-danger"><strong>*</strong></span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control phone-number" name="phone" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Religion <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" name="religion" value="{{ old('religion') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <input type="file" class="form-control" name="avatar">
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="text-danger"><strong>*</strong></span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control pwstrength" data-indicator="pwindicator"
                                            name="password" required>
                                    </div>
                                    <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Division</label>
                                    <select class="form-control select2" id="division">
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}" }}>{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <select class="form-control select2" name="position_id" id="position">
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
                    // width: '350px',
                    allowClear: true,
                    ajax: {
                        url: uri ?? "{{ route('ajax.positions.getPositionByDivision', ['divisionId' => '1']) }}",
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

            $('#division').select2().on('select2:select', function(e) {
                var uri = "{{ route('ajax.positions.getPositionByDivision', ['divisionId' => 'id']) }}";
                uri = uri.replace('id', e.params.data.id);

                initSelect2Position(uri);
            });
        });

        jQuery(function() {
            var cleavePN = new Cleave('.phone-number', {
                phone: true,
                phoneRegionCode: 'id'
            });

            $(".pwstrength").pwstrength();

        });
    </script>
@endpush
