<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Transformers\EmployeeTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::query();

        if (isset(Auth::user()->employee->id)) {
            $employees->where('id', '!=', Auth::user()->employee->id);
        }

        $employees->orderByDesc('created_at');

        return DataTables::of($employees)
            ->filter(function ($query) {
                if (!empty(request('search.value'))) {
                    $term = request('search.value');

                    $query->where('first_name', 'ilike', "%{$term}%")
                        ->orWhere('last_name', 'ilike', "%{$term}%");
                }
            })
            ->orderColumn('full_name', function ($query, $order) {
                $query->orderBy('first_name', $order);
            })
            ->setTransformer(new EmployeeTransformer)
            ->make(true);
    }

    public function getEmployees(Request $request)
    {
        $term = trim($request->term);

        $employees = Employee::query();

        if ($request->type == 'new') {
            $employees->doesntHave('structurals');
        }

        if ($request->type == 'promoted' || $request->type == 'demoted') {
            $employees->has('structurals');
        }

        $employees->select(['id', DB::raw("CONCAT(first_name, ' ', last_name) as text")])
            ->where(function ($query) use ($term) {
                $query->where('first_name', 'ilike',  "%{$term}%")
                    ->orWhere('last_name', 'ilike',  "%{$term}%");
            });

        if (isset(Auth::user()->employee->id)) {
            $employees->where('id', '!=', Auth::user()->employee->id);
        }

        $resultEmployee = $employees->orderBy('first_name', 'asc')->simplePaginate(10);

        $morePages = true;

        if (empty($resultEmployee->nextPageUrl())) {
            $morePages = false;
        }

        $results = array(
            "results" => $resultEmployee->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return response()->json($results);
    }

    public function update(Employee $employee, UpdateEmployeeRequest $request)
    {
        $data = $request->validated();

        if ($request->has('avatar')) {
            if (!$request->file('avatar')->storePublicly($employee->getAvatarPath(), ['disk' => 'public'])) {
                abort(500, __("Image couldn't be saved, please try again"));
            }

            $data['avatar'] = $request->file('avatar')->hashName();
        }

        $employee->update($data);

        return response()->json([
            'message' => __('Success, data ' . $employee->first_name . ' ' . $employee->last_name . ' has been updated.')
        ]);
    }

    public function destroy(Employee $employee)
    {
        $employee->user->delete();
        $employee->delete();

        return response()->json([
            'message' => __('Success, ' . $employee->first_name . ' ' . $employee->last_name . ' has been deleted.')
        ]);
    }
}
