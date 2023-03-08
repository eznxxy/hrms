@extends('layouts.main', ['title' => 'Salaries'])

@push('css')
<style>
    .custom-invoice-detail-value {
        color: #34395e;
        font-weight: 700;
    }

    .custom-invoice-detail-value.custom-invoice-detail-value-lg {
        font-size: 24px;
    }
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Invoice</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payroll</div></a>
            <div class="breadcrumb-item">Invoice</div>
        </div>
    </div>

    <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Invoice</h2>
                            <div class="invoice-number">Salary #{{$payroll->employee->code}}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-5">
                                <address>
                                    <strong>From:</strong><br>
                                    {{$profile->company_name}}<br>
                                    {{$profile->address1}}<br>
                                    +{{$profile->phonecode}}{{$profile->phone}}
                                </address>
                            </div>
                            <div class="col-md-7 text-md-right">
                                <address>
                                    <strong>To:</strong><br>
                                    {{$payroll->employee->full_name}}<br>
                                    {{$payroll->employee->address}}<br>
                                    +{{$payroll->employee->phonecode}}{{$payroll->employee->phone}}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    Bank Transfer<br>
                                    {{$profile->email}}
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Paid Date:</strong><br>
                                    {{Carbon\Carbon::parse($payroll->updated_at)->format('d F Y')}}<br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">Salary Summary</div>
                        <p class="section-lead">All items here cannot be deleted.</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <th data-width="40">#</th>
                                    <th>Description</th>
                                    <th class="text-right">Nominal</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Salary</td>
                                    <td class="text-right">{{\App\Helpers\PriceHelper::format($payroll->salary)}}</td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Incentive</td>
                                    <td class="text-right">{{\App\Helpers\PriceHelper::format($payroll->incentive)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-8">
                                <div class="section-title">Status Payment</div>
                                <p class="section-lead" id="status">{!! $payroll->getStatusHtml() !!}</p>
                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Subtotal</div>
                                    <div class="custom-invoice-detail-value">{{\App\Helpers\PriceHelper::format($payroll->total)}}</div>
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Tax</div>
                                    <div class="custom-invoice-detail-value">Rp 0,00</div>
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="custom-invoice-detail-value custom-invoice-detail-value-lg">{{\App\Helpers\PriceHelper::format($payroll->total)}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-md-right">
                @if (Auth::user()->role_id != 3)
                <div class="float-lg-left mb-lg-0 mb-3">
                    <button class="btn {{$payroll->status != 'paid' ? 'btn-primary':'btn-secondary'}} btn-icon icon-left" type="button" id="pay" {{$payroll->status != 'paid' ? '':'disabled'}}><i class="fas fa-credit-card"></i> Process Payment</button>
                </div>
                @endif
                <a href="{{ route('payrolls.print_invoice', $payroll->id) }}" target="_blank" class="btn {{$payroll->status != 'paid' ? 'btn-secondary disabled':'btn-warning'}} btn-icon icon-left" {{$payroll->status != 'paid' ? 'onclick="return false"':''}}><i class="fas fa-print"></i> Print</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    jQuery(function() {
        const makePayment = () => {
            $.ajax({
                url: "{{ route('ajax.payrolls.pay', ['type' => 'individual']) }}",
                method: 'post',
                data: {
                    idcode: "{{ $payroll->id }}"
                },
                success: function(response) {

                    swal(response.message, {
                        icon: 'success',
                    });

                    location.reload();
                },
                error: function(xhr) {
                    ResponseHelper.handle(xhr);
                }
            });
        }

        $('#pay').on('click', function() {
            swal({
                    title: 'Are you sure?',
                    text: 'You are about to pay {{ $payroll->employee->full_name }} salary for this month, make sure you have made the transfer before continue!',
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