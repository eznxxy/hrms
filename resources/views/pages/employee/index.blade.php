@extends('layouts.main', ['title' => 'Employee'])

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Employee</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Employee</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Employees</h4>
                        <div style="margin-left: auto;">
                            <a href="{{ route('structurals.create') }}" class="btn btn-success">Assign Position</a>
                            <a href="{{ route('employees.create') }}" class="btn btn-primary">New Employee</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="employeeTable">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Full Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Religion</th>
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
        var employeeTable = $('#employeeTable').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: "{{ route('ajax.employees.index') }}",
            columns: [{
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'full_name',
                    name: 'full_name'
                },
                {
                    data: 'date_of_birth',
                    name: 'date_of_birth'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'religion',
                    name: 'religion'
                },
                {
                    data: 'actions',
                    searchable: false,
                    sortable: false
                },
            ]
        });

        const deleteEmployee = (url) => {
            $.ajax({
                url: url,
                method: 'DELETE',
                success: function(response) {

                    swal(response.message, {
                        icon: 'success',
                    });

                    employeeTable.ajax.reload();
                },
                error: function(xhr) {
                    ResponseHelper.handle(xhr);
                }
            });
        }

        $('#employeeTable').on('click', '.delete', function() {
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
                        deleteEmployee(url);
                    }
                });
        });
    });
</script>
@endpush