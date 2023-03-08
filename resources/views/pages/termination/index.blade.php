@extends('layouts.main', ['title' => 'Termination'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Termination</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Termination</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Terminations</h4>
                            <div style="margin-left: auto;">
                                <a href="{{ route('terminations.create') }}" class="btn btn-primary">New Termination</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="terminationTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Employee Name</th>
                                            <th>Category</th>
                                            <th>Noticed at</th>
                                            <th>Terminated at</th>
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
            var terminationTable = $('#terminationTable').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: "{{ route('ajax.terminations.index') }}",
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
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'noticed_at',
                        name: 'noticed_at'
                    },
                    {
                        data: 'terminated_at',
                        name: 'terminated_at'
                    },
                    {
                        data: 'actions',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            const deleteTermination = (url) => {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function(response) {

                        swal(response.message, {
                            icon: 'success',
                        });

                        terminationTable.ajax.reload();
                    },
                    error: function(xhr) {
                        ResponseHelper.handle(xhr);
                    }
                });
            }

            $('#terminationTable').on('click', '.delete', function() {
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
                            deleteTermination(url);
                        }
                    });
            });
        });
    </script>
@endpush
