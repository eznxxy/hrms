<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalaryRequest;
use App\Models\Payroll;
use App\Models\Profile;
use Carbon\Carbon;
use PDF;

class PayrollController extends Controller
{
    public function index()
    {
        return view('pages.payroll.index');
    }

    public function invoice(Payroll $payroll)
    {
        $profile = Profile::first();

        return view('pages.payroll.invoice')->with(compact(['profile', 'payroll']));
    }

    public function printInvoice(Payroll $payroll)
    {
        $profile = Profile::first();

        $pdf = PDF::loadview('pages.pdf.print', ['profile' => $profile, 'payroll' => $payroll]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Salary-'.$payroll->employee->full_name.'-'.Carbon::parse($payroll->created_at)->format('F Y').'.pdf');
    }
}
