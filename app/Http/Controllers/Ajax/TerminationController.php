<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTerminationRequest;
use App\Models\Employee;
use App\Models\Structural;
use App\Models\Termination;
use App\Transformers\TerminationTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TerminationController extends Controller
{
    public function index(Request $request)
    {
        $terminations = Termination::join('employees', 'employees.id', '=', 'terminations.employee_id')
            ->join('termination_categories', 'termination_categories.id', '=', 'terminations.termination_category_id')
            ->select(['terminations.*', 'termination_categories.name as category_name', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) as employee_name")])
            ->orderBy('terminations.created_at', 'desc');

        return DataTables::of($terminations)
            ->filter(function ($query) use ($request) {
                if (!empty(request('search.value'))) {
                    $term = request('search.value');

                    $query->where('employees.first_name', 'ilike', "%{$term}%")
                        ->orWhere('employees.last_name', 'ilike', "%{$term}%");

                    $query->where('employees.id', $request->employee_id);
                }
            })
            ->setTransformer(new TerminationTransformer)
            ->make(true);
    }

    public function update(Termination $termination, UpdateTerminationRequest $request)
    {
        $data = $request->validated();

        if ($data['noticed_at'] > $data['terminated_at']) {
            return response()->json([
                'errors' => [
                    'message' => [
                        0 => __('Error, Notice date cant greater than terminated date!')
                    ]
                ]
            ], 422);
        }

        $termination->update($data);

        return response()->json([
            'message' => __('Success, termination of ' . $termination->employee->full_name . ' has been updated.')
        ]);
    }

    public function destroy(Termination $termination)
    {
        $latestStructural = Structural::where('employee_id', $termination->employee_id)->where('status', 'inactive')->orderBy('created_at', 'desc')->first();
        $latestStructural->status = 'active';
        $latestStructural->save();

        $employee = Employee::whereId($termination->employee_id)->first();
        $employee->status = 'active';
        $employee->save();

        $termination->delete();

        return response()->json([
            'message' => __('Success, data has been deleted.')
        ]);
    }
}
