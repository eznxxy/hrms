<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateIncentiveRequest;
use App\Models\Incentive;
use App\Transformers\IncentiveTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class IncentiveController extends Controller
{
    public function index()
    {
        $salaries = Incentive::query();

        $salaries->join('employees', 'employees.id', '=', 'incentives.employee_id')
            ->select(['incentives.*', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) as employee_name")]);

        if (Auth::user()->role->id == 3) {
            $salaries->where('incentives.employee_id', Auth::user()->employee->id);
        }

        $resultSalaries = $salaries->orderBy('created_at', 'desc');

        return DataTables::of($resultSalaries)
            ->filter(function ($query) {
                if (!empty(request('search.value'))) {
                    $term = request('search.value');

                    $query->where('first_name', 'ilike', "%{$term}%")
                        ->orWhere('last_name', 'ilike', "%{$term}%")
                        ->orWhere('incentives.name', 'ilike', "%{$term}%");
                }
            })
            ->setTransformer(new IncentiveTransformer)
            ->make(true);
    }

    public function update(Incentive $incentive, UpdateIncentiveRequest $request)
    {
        $data = $request->validated();

        $incentive->update($data);

        return response()->json([
            'message' => __('Success, data incentive has been updated.')
        ]);
    }

    public function destroy(Incentive $incentive)
    {
        $incentive->delete();

        return response()->json([
            'message' => __('Success, incentive has been deleted.')
        ]);
    }
}
