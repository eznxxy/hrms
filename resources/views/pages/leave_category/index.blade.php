@extends('layouts.main', ['title' => 'Leave Category'])

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Leave Category</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Leave Category</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Leave Categories</h4>
                        <div style="margin-left: auto;">
                            <button class="btn btn-primary" type="button" id="btnNewCategory">New Category</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="leaveCategoryTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Name</th>
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

@include('modals.leave_category.create')
@endsection

@push('js')
<script>
    jQuery(function() {
        var leaveCategoryTable = $('#leaveCategoryTable').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: "{{ route('ajax.leave_categories.index') }}",
            columns: [{
                    "data": "id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, {
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

        const deleteCategory = (url) => {
            $.ajax({
                url: url,
                method: 'DELETE',
                success: function(response) {

                    swal(response.message, {
                        icon: 'success',
                    });

                    leaveCategoryTable.ajax.reload();
                },
                error: function(xhr) {
                    ResponseHelper.handle(xhr);
                }
            });
        }

        $('#leaveCategoryTable').on('click', '.delete', function() {
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
                        deleteCategory(url);
                    }
                });
        });

        $('#btnNewCategory').click(function() {
            $('#createLeaveCategoryModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        $('#btnSubmit').click(function() {
            var formArray = $('#formLeaveCategory').serializeArray();

            $.ajax({
                method: 'POST',
                url: "{{ route('ajax.leave_categories.store') }}",
                data: formArray,
                beforeSend: function() {
                    $('#btnSubmit').prop('disabled', true);
                    $('#btnSubmit').addClass('btn-progress');
                },
                success: function(response) {
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    }).then(() => {
                        $('#btnSubmit').removeClass('btn-progress');
                        $('#btnSubmit').prop('disabled', false);
                        $('#category_name').val('');

                        $('#createLeaveCategoryModal').modal('hide');
                        leaveCategoryTable.ajax.reload();
                    });
                },
                error: function(xhr) {
                    $('#btnSubmit').removeClass('btn-progress');
                    $('#btnSubmit').prop('disabled', false);
                        $('#category_name').val('');

                    ResponseHelper.handle(xhr);
                }
            });
        });
    });
</script>
@endpush