<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateResignationRequest;
use App\Models\Resignation;
use App\Models\Structural;
use App\Transformers\ResignationTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ResignationController extends Controller
{
    public function index(Request $request)
    {
        $resignation = Resignation::query();

        $resignation->join('employees', 'employees.id', '=', 'resignations.employee_id')
            ->select(['resignations.*', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) as employee_name")]);

        if (Auth::user()->role->name == 'employee') {
            $resignation->where('resignations.employee_id', Auth::user()->employee->id);
        }

        $resultResignation = $resignation->orderBy('resignations.created_at', 'desc');

        if ($request->type == 'dashboard') {
            $resultResignation = $resultResignation->take(3)->get();
        }

        return DataTables::of($resultResignation)
            ->filter(function ($query) use ($request) {
                if (!empty(request('search.value'))) {
                    $term = request('search.value');

                    $query->where('employees.first_name', 'ilike', "%{$term}%")
                        ->orWhere('employees.last_name', 'ilike', "%{$term}%");

                    $query->where('employees.id', $request->employee_id);
                }
            })
            ->setTransformer(new ResignationTransformer)
            ->make(true);
    }

    public function update(Resignation $resignation, UpdateResignationRequest $request)
    {
        $data = $request->validated();

        if ($data['noticed_at'] >= $data['resigned_at']) {
            return response()->json([
                'errors' => [
                    'message' => [
                        0 => __('Error, Notice date cant greater than resigned date!')
                    ]
                ]
            ], 422);
        }

        $resignation->update($data);

        return response()->json([
            'message' => __('Success, your submission has been updated.')
        ]);
    }

    public function destroy(Resignation $resignation)
    {
        $resignation->delete();

        return response()->json([
            'message' => __('Success, data has been deleted.')
        ]);
    }

    public function updateStatus(Resignation $resignation, Request $request)
    {
        if ($request->status == 'approved') {
            Structural::where('employee_id', $resignation->employee->id)->where('status', 'active')->update(['status' => 'inactive']);
        }
        $resignation->status = $request->status;
        $resignation->save();

        return response()->json([
            'message' => __('Success, resign submission has been '. $request->status)
        ]);
    }
}
