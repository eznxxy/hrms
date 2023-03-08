<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice Salary #{{$payroll->employee->code}} / {{Carbon\Carbon::parse($payroll->created_at)->format('F Y')}}</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: right;
            font-size: x-small;
            font-weight: bold;
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td valign="top"><img src="{{$profile->logo_url}}" alt="" width="150" /></td>
            <td align="right">
                <h3>Invoice Salary #{{$payroll->employee->code}} / {{Carbon\Carbon::parse($payroll->created_at)->format('F Y')}}</h3>
                <h3>{{$profile->company_name}}</h3>
                {{$profile->chief}} <br>
                {{$profile->address1}} <br>
                +{{$profile->phonecode}} {{$profile->phone}} <br>
                {{$profile->email}} <br>
            </td>
        </tr>

    </table>

    <table width="100%">
        <tr>
            <td><strong>Paid Date: {{Carbon\Carbon::parse($payroll->updated_at)->format('d F Y')}}</strong></td>
            <td style="text-align: right;"><strong>To:</strong> {{$payroll->employee->full_name}}</td>
        </tr>

    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th align="left">Description</th>
                <th align="right" style="width: 12%;">Nominal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Salary</td>
                <td align="right">{{\App\Helpers\PriceHelper::format($payroll->salary)}}</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Incentive</td>
                <td align="right">{{\App\Helpers\PriceHelper::format($payroll->incentive)}}</td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="1"></td>
                <td align="right">Subtotal</td>
                <td align="right">{{\App\Helpers\PriceHelper::format($payroll->total)}}</td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td align="right">Tax</td>
                <td align="right">Rp 0.00</td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td align="right">Total</td>
                <td align="right" class="gray">{{\App\Helpers\PriceHelper::format($payroll->total)}}</td>
            </tr>
        </tfoot>
    </table>
    <br>
    <div class="footer">
        <strong>Print Date: {{Carbon\Carbon::parse($payroll->updated_at)->format('d F Y')}}</strong>
    </div>

</body>

</html>