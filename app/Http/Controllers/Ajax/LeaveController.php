<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateLeaveRequest;
use App\Http\Requests\UpdateResignationRequest;
use App\Models\Leave;
use App\Models\Resignation;
use App\Models\Structural;
use App\Transformers\LeaveTransformer;
use App\Transformers\ResignationTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $leave = Leave::query();

        $leave->join('employees', 'employees.id', '=', 'leaves.employee_id')
            ->select(['leaves.*', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) as employee_name")]);

        if (Auth::user()->role->name == 'employee') {
            $leave->where('leaves.employee_id', Auth::user()->employee->id);
        }

        $resultLeave = $leave->orderBy('leaves.created_at', 'desc');

        if ($request->type == 'dashboard') {
            $resultLeave = $resultLeave->take(3)->get();
        }

        return DataTables::of($resultLeave)
            ->filter(function ($query) use ($request) {
                if (!empty(request('search.value'))) {
                    $term = request('search.value');

                    $query->where('employees.first_name', 'ilike', "%{$term}%")
                        ->orWhere('employees.last_name', 'ilike', "%{$term}%");

                    $query->where('employees.id', $request->employee_id);
                }
            })
            ->setTransformer(new LeaveTransformer)
            ->make(true);
    }

    public function update(Leave $leave, UpdateLeaveRequest $request)
    {
        $data = $request->validated();

        if ($data['start_at'] >= $data['end_at']) {
            return response()->json([
                'errors' => [
                    'message' => [
                        0 => __('Error, Start date cant greater than end date!')
                    ]
                ]
            ], 422);
        }

        $leave->update($data);

        return response()->json([
            'message' => __('Success, your submission has been updated.')
        ]);
    }

    public function destroy(Leave $leave)
    {
        $leave->delete();

        return response()->json([
            'message' => __('Success, data has been deleted.')
        ]);
    }

    public function updateStatus(Leave $leave, Request $request)
    {
        if ($request->status == 'approved') {
            Structural::where('employee_id', $leave->employee->id)->where('status', 'active')->update(['status' => 'inactive']);
        }
        $leave->status = $request->status;
        $leave->save();

        return response()->json([
            'message' => __('Success, leave submission has been '. $request->status)
        ]);
    }
}
