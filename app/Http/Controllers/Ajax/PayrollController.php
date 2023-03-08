<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Incentive;
use App\Models\Payroll;
use App\Models\Salary;
use App\Transformers\PayrollTransformer;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function index()
    {
        $payroll = Payroll::query();

        $payroll->join('employees', 'employees.id', '=', 'payrolls.employee_id')
            ->select(['payrolls.*', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) as employee_name")]);

        if (Auth::user()->role->name == 'employee') {
            $payroll->where('payrolls.employee_id', Auth::user()->employee->id);
        }

        $resultPayroll = $payroll->orderBy('created_at', 'desc');

        return DataTables::of($resultPayroll)
            ->filter(function ($query) {
                if (!empty(request('search.value'))) {
                    $term = request('search.value');

                    $query->where('first_name', 'ilike', "%{$term}%")
                        ->orWhere('last_name', 'ilike', "%{$term}%");
                }
            })
            ->setTransformer(new PayrollTransformer)
            ->make(true);
    }

    public function generate()
    {
        $dataPayroll = [];
        $currentDateTime = Carbon::now();

        $payroll = new Payroll();

        $payrolls = $payroll->whereMonth('created_at', $currentDateTime->month)->whereYear('created_at', $currentDateTime->year)->exists();

        if ($payrolls) {
            return response()->json([
                'errors' => [
                    'message' => [
                        0 => __('Payroll for this month is already generated!')
                    ]
                ]
            ], 409);
        }

        $incentive = new Incentive();

        $incentives = $incentive->join('employees', 'employees.id', '=', 'incentives.employee_id')
            ->select(['incentives.*', 'employees.status'])
            ->where('incentives.status', 'pending')
            ->where('employees.status', 'active')
            ->get();

        $salaries = Salary::get();

        $unAssignedEmployees = Employee::doesnthave('structurals')->count();

        if ($unAssignedEmployees != 0) {
            return response()->json([
                'errors' => [
                    'message' => [
                        0 => __('Error, there is ' . $unAssignedEmployees . ' employees who has not been assigned a position. Please assign first!')
                    ]
                ]
            ], 422);
        }

        $employees = Employee::where('status', 'active')->get();

        foreach ($employees as $key => $employee) {
            $incentiveNominal = 0;
            $salaryNominal = intval($salaries->where('position_id', $employee->structurals->where('status', 'active')->first()->position_id)->first()->nominal);

            foreach ($incentives as $key => $value) {
                if ($employee->id == $value->employee_id) {
                    $incentiveNominal += $value->nominal;
                }
            }

            $dataPayroll[] = [
                'employee_id' => $employee->id,
                'incentive' => $incentiveNominal,
                'salary' => $salaryNominal,
                'total' => $incentiveNominal + $salaryNominal,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $payroll->insert($dataPayroll);

        $incentive->whereIn('id', $incentives->pluck('id'))->update(['status' => 'paid']);

        return response()->json([
            'message' => __('Success, payroll for this month has been generated.')
        ]);
    }

    public function pay(Request $request)
    {
        $currentDateTime = Carbon::now();

        $payroll = new Payroll();

        if ($request->type == 'individual') {
            $payrolls = $payroll->whereId($request->idcode)->where('status', 'pending');
        }

        if (!isset($request->type)) {
            $payrolls = $payroll->whereMonth('created_at', $currentDateTime->month)->whereYear('created_at', $currentDateTime->year)->where('status', 'pending');
        }

        if (!$payrolls->count() != 0) {
            return response()->json([
                'errors' => [
                    'message' => [
                        0 => __('All salaries for this month have been paid or have not been generated yet!')
                    ]
                ]
            ], 409);
        }

        $resulPayroll = $payrolls->pluck('id');

        $payroll->whereIn('id', $resulPayroll)->update(['status' => 'paid']);

        return response()->json([
            'message' => __('Success, payroll for this month has been paid.'),
        ]);
    }
}
