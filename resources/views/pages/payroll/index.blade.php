@extends('layouts.main', ['title' => 'Payroll'])

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Payroll</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Payroll</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Payrolls</h4>
                        @if (Auth::user()->role_id != 3)
                        <div style="margin-left: auto;">
                            <button id="generate" class="btn btn-primary">Generate</button>
                            <button id="pay" class="btn btn-success">Make Payment</button>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="payrollTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Employee Name</th>
                                        <th>Incentive</th>
                                        <th>Salary</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Created at</th>
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
        var payrollTable = $('#payrollTable').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: "{{ route('ajax.payrolls.index') }}",
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
                    data: 'incentive',
                    name: 'incentive'
                },
                {
                    data: 'salary',
                    name: 'salary'
                },
                {
                    data: 'total',
                    name: 'total'
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
                    data: 'actions',
                    searchable: false,
                    sortable: false
                },
            ]
        });

        const generatePayroll = () => {
            $.ajax({
                url: "{{ route('ajax.payrolls.generate') }}",
                method: 'post',
                success: function(response) {

                    swal(response.message, {
                        icon: 'success',
                    });

                    payrollTable.ajax.reload();
                },
                error: function(xhr) {
                    ResponseHelper.handle(xhr);
                }
            });
        }

        const makePayment = () => {
            $.ajax({
                url: "{{ route('ajax.payrolls.pay') }}",
                method: 'post',
                success: function(response) {

                    swal(response.message, {
                        icon: 'success',
                    });

                    payrollTable.ajax.reload();
                },
                error: function(xhr) {
                    ResponseHelper.handle(xhr);
                }
            });
        }

        $('#generate').on('click', function() {
            swal({
                    title: 'Are you sure?',
                    text: 'You are about to generate the salary for this month',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willGenerate) => {
                    if (willGenerate) {
                        generatePayroll();
                    }
                });
        });

        $('#pay').on('click', function() {
            swal({
                    title: 'Are you sure?',
                    text: 'You are about to pay all the salary for this month, make sure you have made the transfer before continue!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willPay) => {
                    if (willPay) {
                        makePayment();
                    }
                });
        });
    });
</script>
@endpush