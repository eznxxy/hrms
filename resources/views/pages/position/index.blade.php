@extends('layouts.main', ['title' => 'Position'])

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Position</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Position</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Positions</h4>
                        <div style="margin-left: auto;">
                            <a href="{{ route('positions.create') }}" class="btn btn-primary">New Position</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="positionTable">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Division Name</th>
                                        <th>Position Name</th>
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
        var positionTable = $('#positionTable').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: "{{ route('ajax.positions.index') }}",
            columns: [{
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'division_name',
                    name: 'division_name'
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

        const deletePosition = (url) => {
            $.ajax({
                url: url,
                method: 'DELETE',
                success: function(response) {

                    swal(response.message, {
                        icon: 'success',
                    });

                    positionTable.ajax.reload();
                },
                error: function(xhr) {
                    ResponseHelper.handle(xhr);
                }
            });
        }

        $('#positionTable').on('click', '.delete', function() {
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
                        deletePosition(url);
                    }
                });
        });
    });
</script>
@endpush