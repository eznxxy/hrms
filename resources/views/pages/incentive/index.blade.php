@extends('layouts.main', ['title' => 'Incentive'])

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Incentive</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Incentive</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Incentives</h4>
                        @if (Auth::user()->role_id != 3)
                        <div style="margin-left: auto;">
                            <a href="{{ route('incentives.create') }}" class="btn btn-primary">New Incentive</a>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="incentiveTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Employee Name</th>
                                        <th>Name</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
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
        var incentiveTable = $('#incentiveTable').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: "{{ route('ajax.incentives.index') }}",
            columns: [{
                    "data": "id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, {
                    data: 'employee_name',
                    name: 'employee_name'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'nominal',
                    name: 'nominal'
                },
                {
                    data: 'status',
                    name: 'status'
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

        const deleteIncentive = (url) => {
            $.ajax({
                url: url,
                method: 'DELETE',
                success: function(response) {

                    swal(response.message, {
                        icon: 'success',
                    });

                    incentiveTable.ajax.reload();
                },
                error: function(xhr) {
                    ResponseHelper.handle(xhr);
                }
            });
        }

        $('#incentiveTable').on('click', '.delete', function() {
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
                        deleteIncentive(url);
                    }
                });
        });
    });
</script>
@endpush