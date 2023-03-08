@extends('layouts.main', ['title' => 'Salaries'])

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Salaries</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Salary</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Salary</h4>
                        <div style="margin-left: auto;">
                            <a href="{{ route('salaries.create') }}" class="btn btn-primary">New Salary</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="salaryTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Position Name</th>
                                        <th>Nominal</th>
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
</section>
@endsection

@push('js')
<script>
    jQuery(function() {
        var salaryTable = $('#salaryTable').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: "{{ route('ajax.salaries.index') }}",
            columns: [{
                    "data": "id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, {
                    data: 'position_name',
                    name: 'position_name'
                },
                {
                    data: 'nominal',
                    name: 'nominal'
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
    });
</script>
@endpush